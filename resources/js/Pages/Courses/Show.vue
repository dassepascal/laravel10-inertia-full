<template>
  <app-layout>
    <template #header>
      {{ course.title }}
    </template>
    <div class="py-3">
      <div class="text-2xl text-gray-500">
        {{ course.episodes[this.currentKey].title }}
      </div>
      <iframe
        class="w-full"
        h-screen
        :src="course.episodes[this.currentKey].video_url"
        frameborder="100"
        allowfullscreen
      ></iframe>

      <div class="text-sm text-gray-500">
        {{ course.episodes[this.currentKey].description }}
      </div>
      <div class="flex justify-center items-center py-6">
        <progress-bar
        :watched-episodes="watched"
        :episodes="course.episodes"
         />
      </div>

      <div class="mt-6">
        <ul
          v-for="(episode, index) in this.course.episodes"
          v-bind:key="episode.id"
        >
          <li class="mt-3 flex justify-between items-center">
            <div>
              Episode n° {{ index + 1 }} - {{ episode.title }}
              <button
                class="text-gray-500 focus:text-indigo-500 focus:outline-none"
                @click="switchEpisode(index)"

              >
                Voir l'épisode
              </button>
            </div>

            <progress-button
             :episode-id="episode.id"
             :watched-episodes="watched" />
          </li>
        </ul>
      </div>
    </div>
  </app-layout>
</template>

<script >
import AppLayout from '@/Layouts/AppLayout.vue'
import ProgressButton from './ProgressButton.vue'
import ProgressBar from './ProgressBar.vue'

export default {
  components: { AppLayout, ProgressButton, ProgressBar },

  props: ['course','watched'],

  data() {
    return {
      courseShow: this.course,
      currentKey: 0,
    }
  },
  methods: {
    switchEpisode(index) {
        console.log(index)
      this.currentKey = index

      window.scrollTo({
        top: 0,
        left: 0,
        behavior: 'smooth',
      })
    },
  },

  mounted() {
    //console.log(this.currentKey)
  },
}
</script>
