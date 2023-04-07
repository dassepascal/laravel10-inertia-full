<template>
  <app-layout>
    <template #header>
      liste des formations 2021
    </template>
    <div class="py-3" v-for="course in courseList.data" v-bind:key="course.id">

      <div class="text-sm text-gray-500">
        Mise en ligne par: {{ course.user.name }} -
        <span class="text-red-500 text-sm">
          {{ course.participants }} participant
          <!-- todo coller s  -->
          <span  v-if="parseInt(course.participants)>1 ">s</span></span>
      </div>
      <div class="mx-8 bg-white rounded shadow py-4 px-4">
        <div class="flex justify-between items-center">
          <div class="text-2xl">{{ course.title }}</div>
          <div class="text-sm text-gray-400">
            {{ course.episodes_count }} épisodes
          </div>
        </div>
<span class="font-semibold text-gray-500">{{ convert(course.total_duration) }}</span>
        <div class="text-sm text-gray-500">{{ course.description }}</div>
        <a
          :href="'course/' + course.id"
          class="bg-indigo-500 text-white px-2 py-1 text-sm mt-3 rounded inline-block hover:bg-indigo-700"
        >
          Voir la formation
        </a>
       <div class="flex items-center justify-between">
        <a
          :href="'courses/edit/' + course.id"
          v-if="course.update"
          class="bg-gray-500 text-white px-2 py-1 text-sm mt-3 rounded inline-block hover:bg-gray-700"
        >
        edit
        </a>
        </div>
      </div>

    </div>
    <div >
    <!-- pagination -->
<div class="mt-6 ml-6">

<Link
    v-for=" link in courses.links"
    v-bind:key="link.label"
    :href="link.url"

    class="bg-indigo-500 text-white px-2 py-1 text-sm mt-3 rounded inline-block hover:bg-indigo-700"
    >{{ link.label }}</Link>




</div>

    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'

 import {Link} from '@inertiajs/vue3'



export default {
  components: { AppLayout, Link },

  props: {
    courses: Object,
    links: Array,
  },

  methods:{

    convert(timestamps) {
     let hours = Math.floor( timestamps / 3600);
     let minutes =Math.floor( (timestamps /60) - (hours /60));
     let seconds = timestamps % 60;

     return hours.toString().padStart(2,0) + ':' +minutes.toString().padStart(2,0) + ':' + seconds.toString().padStart(2,0);
    }
  },

  data() {
    return {
      courseList: this.courses,
    }
  },

  mounted() {
    console.log(this.courseList)
  },
}
</script>
