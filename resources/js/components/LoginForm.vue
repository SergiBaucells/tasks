<template>
    <v-form action="/login" method="POST">
        <v-toolbar dark color="primary">
            <v-toolbar-title>Formulari d'inici de sessió</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn flat type="submit" href="/">Enrere</v-btn>
        </v-toolbar>
        <v-card-text>
            <input type="hidden" name="_token" :value="csrfToken">
            <v-text-field
                    prepend-icon="person"
                    name="email"
                    label="Iniciar Sessió"
                    type="text"
                    v-model="dataEmail"
                    :error-messages="emailErrors"
                    @input="$v.dataEmail.$touch()"
                    @blur="$v.dataEmail.$touch()"
            ></v-text-field>
            <v-text-field
                    id="password"
                    prepend-icon="lock"
                    name="password"
                    label="Contrasenya"
                    type="password"
                    :error-messages="passwordErrors"
                    @input="$v.password.$touch()"
                    @blur="$v.password.$touch()"
                    v-model="password"></v-text-field>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" type="submit" :disabled="$v.$invalid">Iniciar Sessió</v-btn>
            <v-spacer></v-spacer>
        </v-card-actions>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" href="/auth/facebook">Login amb Facebook</v-btn>
            <v-spacer></v-spacer>
        </v-card-actions>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" href="/auth/github">Login amb GitHub</v-btn>
            <v-spacer></v-spacer>
        </v-card-actions>
        <v-card-text class="text-md-center">
            Ets nou a la App?
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" type="submit" href="/register" class="mb-3">Crea el teu compte
            </v-btn>
            <v-spacer></v-spacer>
        </v-card-actions>
        <v-card-text class="text-md-center">
            Has olvidat la contrasenya?
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" type="submit" href="/password/reset" class="mb-3">Actualitza-la!
            </v-btn>
            <v-spacer></v-spacer>
        </v-card-actions>
    </v-form>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required, email, minLength } from 'vuelidate/lib/validators'

export default {
  name: 'LoginForm',
  mixins: [validationMixin],
  validations: {
    dataEmail: { required, email },
    password: { required, minLength: minLength(6) }
  },
  data () {
    return {
      dataEmail: this.email,
      password: ''
    }
  },
  props: ['email', 'csrfToken'],
  computed: {
    emailErrors () {
      const errors = []
      if (!this.$v.dataEmail.$dirty) return errors
      !this.$v.dataEmail.email && errors.push('El camp email ha de ser tipus email.')
      !this.$v.dataEmail.required && errors.push('El camp email és obligatori.')
      return errors
    },
    passwordErrors () {
      const errors = []
      if (!this.$v.password.$dirty) return errors
      !this.$v.password.required && errors.push('El password és obligatori.')
      !this.$v.password.minLength && errors.push('El camp password ha de tenir una mida minima de 6 caràcters.')
      return errors
    }
  }
}
</script>
