<template>
    <v-container
            fill-height
            fluid
            grid-list-xl>
        <v-layout
                justify-center
                wrap
        >
            <v-flex
                    xs12
                    md8
            >
                <v-card>
                    <v-toolbar color="primary">
                        <v-toolbar-title class="white--text">Perfil</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-form class="mt-4">
                        <v-container py-0>
                            <v-layout wrap>
                                <v-flex
                                        xs12
                                        md6
                                >
                                    <v-text-field
                                            class="purple-input"
                                            label="User Name"
                                    />
                                </v-flex>
                                <v-flex
                                        xs12
                                        md6
                                >
                                    <v-text-field
                                            label="Email Address"
                                            class="purple-input"/>
                                </v-flex>
                                <v-flex
                                        xs12
                                        md6
                                >
                                    <v-text-field
                                            label="Admin"
                                            class="purple-input"/>
                                </v-flex>
                                <v-flex
                                        xs12
                                        md6
                                >
                                    <v-text-field
                                            label="Roles"
                                            class="purple-input"/>
                                </v-flex>
                                <v-flex
                                        xs12
                                        md12
                                >
                                    <v-text-field
                                            label="Permissions"
                                            class="purple-input"/>
                                </v-flex>
                                <!--<v-flex-->
                                <!--xs12-->
                                <!--md4>-->
                                <!--<v-text-field-->
                                <!--label="City"-->
                                <!--class="purple-input"/>-->
                                <!--</v-flex>-->
                                <!--<v-flex-->
                                <!--xs12-->
                                <!--md4>-->
                                <!--<v-text-field-->
                                <!--label="Country"-->
                                <!--class="purple-input"/>-->
                                <!--</v-flex>-->
                                <!--<v-flex-->
                                <!--xs12-->
                                <!--md4>-->
                                <!--<v-text-field-->
                                <!--class="purple-input"-->
                                <!--label="Postal Code"-->
                                <!--type="number"/>-->
                                <!--</v-flex>-->
                                <!--<v-flex xs12>-->
                                <!--<v-textarea-->
                                <!--class="purple-input"-->
                                <!--label="About Me"-->
                                <!--value="Lorem ipsum dolor sit amet, consectetur adipiscing elit."-->
                                <!--/>-->
                                <!--</v-flex>-->
                                <v-flex
                                        xs12
                                        text-xs-right
                                >
                                    <v-btn
                                            class="mx-0 font-weight-light"
                                            color="success"
                                    >
                                        Modificar
                                    </v-btn>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-form>
                </v-card>
            </v-flex>
            <v-flex
                    xs12
                    md4
            >
                <material-card class="v-card-profile">
                    <v-avatar
                            slot="offset"
                            class="mx-auto d-block"
                            size="130"
                    >
                        <img
                                ref="img_avatar"
                                src="/user/avatar"
                        >
                    </v-avatar>
                    <v-card-text class="text-xs-center">
                        <p>Username here</p>
                        <form action="/avatar" method="POST" enctype="multipart/form-data">
                            <input type="file" name="avatar" id="avatar-file-input" ref="avatar" accept="image/*">
                            <input type="hidden" name="_token" :value="csrf_token">
                            <input type="submit" value="Pujar">
                        </form>
                        <v-btn
                                color="success"
                                round
                                class="font-weight-light"
                        >Upload Avatar</v-btn>
                        <p>TODO LIST AVATARS here</p>
                    </v-card-text>
                </material-card>
                <material-card class="v-card-profile">
                    <v-avatar
                            slot="offset"
                            class="mx-auto d-block"
                            size="130"
                    >
                        <img
                                ref="img_photo"
                                src="/user/photo"
                                @click="selectFiles"
                        >
                    </v-avatar>
                    <v-card-text class="text-xs-center">
                        <p>Username here</p>
                        <form action="/photo" method="POST" enctype="multipart/form-data">
                            <input type="file" name="photo" id="photo-file-input" ref="photo" accept="image/*" capture @change="upload">
                            <input type="hidden" name="_token" :value="csrf_token">
                            <input type="submit" value="Pujar">
                        </form>
                        <v-btn
                                color="success"
                                round
                                class="font-weight-light"
                                @click="selectFiles"
                                :loading="uploading"
                                :disabled="uploading"
                        >Upload Photo</v-btn>
                    </v-card-text>
                </material-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
import MaterialCard from './ui/MaterialCard'
export default {
  name: 'Profile',
  data () {
    return {
      uploading: false,
      percentCompleted: 0
    }
  },
  components: {
    'material-card': MaterialCard
  },
  methods: {
    preview () {
      if (this.$refs.photo.files && this.$refs.photo.files[0]) {
        var reader = new FileReader()
        // Asincornament definim que executem un cop imatge sigui llegida
        reader.onload = e => {
          // Canviem la imatge que mostra la foto utilitzant el resultat de llegir el fitxer capturar per l'input de tipus file
          this.$refs.img_photo.setAttribute('src', e.target.result)
        }
        // Definim la font de l'strema com una URL. Començara llegir i un cop llegit executar onload event definit a la línia anterior
        reader.readAsDataURL(this.$refs.photo.files[0])
      }
    },
    save (formData) {
      this.uploading = true

      var config = {
        onUploadProgress: progressEvent => {
          this.percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total)
        }
      }

      window.axios.post('/api/v1/user/photo', formData, config)
        .then(() => {
          this.uploading = false
          this.$snackbar.showMessage('Ok!')
        })
        .catch(error => {
          console.log(error)
          this.$snackbar.showError(error)
          this.uploading = false
        })
    },
    selectFiles () {
      this.$refs.photo.click()
    },
    upload () {
      // handle input photo changes
      const formData = new FormData()
      formData.append('photo', this.$refs.photo.files[0])

      // Preview it
      this.preview()

      // save it
      this.save(formData)
    }
  },
  created () {
    this.csrf_token = window.csrf_token
  }
}
</script>

<style scoped>
    input[type=file] {
        position: absolute;
        left: -99999px;
    }
</style>
