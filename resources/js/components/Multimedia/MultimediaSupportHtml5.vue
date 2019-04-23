<template>
    <span>
        <video id="demovideo" src="http://clips.vorwaerts-gmbh.de/VfE_html5.mp4" preload="auto" controls></video>

        <v-slider
                v-model="volume"
                @input="updateVolume('demovideo')"
                max="1"
                step="any"
                append-icon="volume_up"
                prepend-icon="volume_down"
                style="width: 20%"
        ></v-slider>

        <v-flex>
            <v-btn icon>
                <v-icon @click="play('demovideo')">play_arrow</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="pause('demovideo')">pause</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="upVolume('demovideo')">volume_up</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="downVolume('demovideo')">volume_down</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="rewind('demovideo')">fast_rewind</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="forward('demovideo')">fast_forward</v-icon>
            </v-btn>
        </v-flex>

        <v-divider></v-divider>

        <div class="test">Back in black:</div>

        <audio id="demo" src="https://upload.wikimedia.org/wikipedia/en/4/45/ACDC_-_Back_In_Black-sample.ogg" preload="auto" controls></audio>

        <v-slider
                v-model="volume"
                @input="updateVolume('demo')"
                max="1"
                step="any"
                append-icon="volume_up"
                prepend-icon="volume_down"
                style="width: 20%"
        ></v-slider>

        <v-flex>
            <v-btn icon>
                <v-icon @click="play('demo')">play_arrow</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="pause('demo')">pause</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="upVolume('demo')">volume_up</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="downVolume('demo')">volume_down</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="rewind('demo')">fast_rewind</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="forward('demo')">fast_forward</v-icon>
            </v-btn>
        </v-flex>

        <v-divider></v-divider>

        <div class="test">Audio Another day in paradise:</div>

        <audio id="demo2" src="https://upload.wikimedia.org/wikipedia/en/9/9f/Sample_of_%22Another_Day_in_Paradise%22.ogg" preload="auto" controls></audio>

        <v-slider
                v-model="volume"
                @input="updateVolume('demo2')"
                max="1"
                step="any"
                append-icon="volume_up"
                prepend-icon="volume_down"
                style="width: 20%"
        ></v-slider>

        <v-flex>
            <v-btn icon>
                <v-icon @click="play('demo2')">play_arrow</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="pause('demo2')">pause</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="upVolume('demo2')">volume_up</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="downVolume('demo2')">volume_down</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="rewind('demo2')">fast_rewind</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="forward('demo2')">fast_forward</v-icon>
            </v-btn>
        </v-flex>

        <v-divider></v-divider>

        <div class="test">Audio Bullet in the head:</div>

        <audio id="demo3" src="https://upload.wikimedia.org/wikipedia/en/1/17/Bullet_In_The_Head.ogg" preload="auto" controls></audio>

        <v-slider
                v-model="volume"
                @input="updateVolume('demo3')"
                max="1"
                step="any"
                append-icon="volume_up"
                prepend-icon="volume_down"
                style="width: 20%"
        ></v-slider>

        <v-flex>
            <v-btn icon>
                <v-icon @click="play('demo3')">play_arrow</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="pause('demo3')">pause</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="upVolume('demo3')">volume_up</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="downVolume('demo3')">volume_down</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="rewind('demo3')">fast_rewind</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon @click="forward('demo3')">fast_forward</v-icon>
            </v-btn>
        </v-flex>

        <v-divider></v-divider>

        <a href="https://developer.mozilla.org/es/docs/Web/HTML/Usando_audio_y_video_con_HTML5">Més info</a>
    </span>
</template>

<script>
export default {
  name: 'MultimediaSupportHtml5',
  data () {
    return {
      volume: 0.5
    }
  },
  methods: {
    play ($id) {
      document.getElementById($id).play()
    },
    pause ($id) {
      document.getElementById($id).pause()
    },
    upVolume ($id) {
      document.getElementById($id).volume += 0.1
    },
    downVolume ($id) {
      document.getElementById($id).volume -= 0.1
    },
    updateVolume ($id) {
      let video = document.getElementById($id)
      video.volume = this.volume
    },
    forward ($id) {
      let video = document.getElementById($id)
      video.currentTime += +10
    },
    rewind ($id) {
      let video = document.getElementById($id)
      video.currentTime += -10
    }
  }
}
</script>
