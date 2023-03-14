<template>
  <div class="bg-gray-200 w-full rounded">
    <div
      class="bg-green-500 text-white rounded-l text-center transition-width duration-500"
      :style="'width:' + percentage + '%'"
    >
      {{ percentage }}%
    </div>
  </div>
</template>

<script>
import bus from 'vue3-eventbus'
export default {
  props: ['watchedEpisodes', 'episodes'],
  data() {
    return {
      watchedEpisodesdata: this.watchedEpisodes,
    }
  },

  computed: {
    //comparer dans les tableaux les valeurs identiques

    // percentage(){
    //     let filteredEp = this.episodes.filter(courseEp =>{
    //        return this.watchedEpisodes.find(watchedEp =>{
    //             return watchedEp.id === courseEp.id;
    //         });
    //        });
    //        return Math.ceil(filteredEp.length / this.episodes.length * 100);

    // }

    //mise à jour de la barre de progression
    percentage() {
      let filteredEp = this.episodes.filter((courseEp) => {
        return this.watchedEpisodesdata.find((watchedEp) => {
          return watchedEp.id === courseEp.id
        })
      })
      return Math.ceil((filteredEp.length / this.episodes.length) * 100)
    },
  },
  mounted() {
    bus.on('toggleProgress', (data) => (this.watchedEpisodesdata = data))
  },
}
</script>
<style></style>
