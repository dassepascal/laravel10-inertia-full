<template>
    <div>
    <button class="bg-green-500 px-2 py-3 text-white rounded" @click="toggleProgress">
    {{ this.isWatched  ? 'Terminé' : 'Terminé ?' }}</button>
    </div>

</template>

<script>

import bus from 'vue3-eventbus'
 export default {
    props: ['episodeId', 'watchedEpisodes'],
    data() {
        return {
            watchedEp: this.watchedEpisodes,
            isWatched: null,
        }
    },
methods: {
    toggleProgress() {
        console.log('clic toggleProgress')
        axios.post('/toggleProgress', {

            episodeId: this.episodeId,
        })
        .then(response => {
            console.log('ok')
           if(response.status === 200) {
               this.isWatched = !this.isWatched;
               // quand je vais cliquer sur le bouton, je vais emettre un evenement et je vais passer en parametre la reponse de la requete
               bus.emit('toggleProgress', response.data);

           }
        })
        .catch(error => console.log(error))
    },

    isWatchedEpisode(){
        //console.log('episode')

       // console.log( this.watchedEp.find(episode => episode.id === this.episodeId) ? 'true' : 'false');
        return this.watchedEp.find(episode => episode.id === this.episodeId) ? true : false;

    }

    },
    mounted() {
       // console.log('this.watchedEp')
 this.isWatched = this.isWatchedEpisode();
        // console.log('mounted', this.isWatched)
     }
 }
</script>
