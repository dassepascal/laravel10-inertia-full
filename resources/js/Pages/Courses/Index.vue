<template>
  <app-layout>
    <template #header>
      liste des formations
    </template>
    <div class="py-3" v-for="course in this.courseList" v-bind:key="course.id">
    <div class="text-sm text-gray-500"> Mise en ligne par: {{ course.user.name }}</div>
      <div class="mx-8 bg-white rounded shadow py-4 px-4">
      <div class="flex justify-between items-center ">
        <div class="text-2xl">  {{ course.title }}</div>
        <div class="text-sm text-gray-400">{{ course.episodes_count }} épisodes</div>
      </div>

      <div class="text-sm text-gray-500">{{ course.description }}</div>
      <a href="{{ route('courses.show') }}" class="bg-indigo-500 text-white px-2 py-1 text-sm mt-3 rounded inline-block hover:bg-indigo-700">Voir la formation</a>
      </div>

    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
export default {
  components: { AppLayout },
  data() {
    return {
      courseList: this.courses,
    }
  },
  props: ['courses'],

  mounted() {
    console.log(this.courseList)
  },
}
</script>
