<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';

//  defineProps({errors:Object});


const form = reactive({
    title: null,
    description: null,
    episodes: [
                {
                    title: null,
                    description: null,
                    video_url: null

                },
            ],

});

function submit() {
    router.post('/courses',form);
}

export default {
props:{
    errors:Object,
},

    components: {
        AppLayout
    },
    data() {
        console.log('episodes', form);
        return {
            form,
            episodes: [
                {
                    title: null,
                    description: null,
                    video_url: null,

                },
            ],


        }


    },
    methods: {
        submit,
        add() {
            console.log('add', this.form.episodes)

            this.form.episodes.push({

                title: null,
                description: null,
                video_url: null,
            })
        },
        remove() {

            this.form.episodes.pop();
        }


    }
}


</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- message -->
                <div v-if="$page.props.flash.message" class="bg-green-200 text-green-500 p-3 mb-8 text-center rounded ">
                    {{ $page.props.flash.message }}
                </div>

                <div class="w-full ">
                    <form @submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Titre de la formation
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="title" type="text" v-model="form.title">
                                <div class="bg-red-200 text-red-500 p-1 mt-1 text-center rounded " v-if="errors.title">{{ errors.title }}</div>
                        </div>


                            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                Description de la formation
                            </label>
                            <textarea
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="description" type="text" v-model="form.description"></textarea>
                                <div class="bg-red-200 text-red-500 p-1 mt-1 text-center rounded "  v-if="errors.description">{{ errors.description }}</div>

                        <div class="mb-4">
                            <h2 class="text-2xl">Episodes de la formation</h2>
                            <div v-for="(episode, index) in this.form.episodes  " v-bind:key="index">
                                <label class="block text-gray-700 text-sm font-bold mb-2" :for="'title-' + index">
                                    Titre de l'episode n°{{ index + 1 }}
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    type="text" :id="'title -' + index" v-model="form.episodes[index].title">
                                    <div class="bg-red-200 text-red-500 p-1 mt-1 text-center rounded " v-if="errors['episodes.'+index+'.title']">{{ errors['episodes.'+index+'.title'] }}</div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" :for="'description-' + index">
                                        Description de l'episode n°{{ index + 1 }}
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        type="text" :id="'description -' + index" v-model="form.episodes[index].description">
                                        <div class="bg-red-200 text-red-500 p-1 mt-1 text-center rounded " v-if="errors['episodes.'+index+'.description']">{{ errors['episodes.'+index+'.description'] }}</div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" :for="'video_url-' + index">
                                        Url de l'episode n°{{ index + 1 }}
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline "
                                        type="text" :id="'video_url -' + index" v-model="form.episodes[index].video_url">
                                        <div  class="bg-red-200 text-red-500 p-1 mt-1 text-center rounded " v-if="errors['episodes.' + index + '.video_url']">{{errors['episodes.' + index + '.video_url'] }}</div>
                            </div>
                        </div>
                        <!-- ne pas oublier le prevent sinon le formulaire va être renvoyer à chaqu fois -->
                        <button class="bg-green-600 rounded py-4 px-4 my-2 text-white  block" v-if="form.episodes.length < 15" @click.prevent="add">+
                        </button>
                        <button class="bg-red-600 rounded py-4 px-4 my-2 text-white  block" v-if="form.episodes.length > 1" @click.prevent="remove">    🗑️                     </button>

                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                            Créer ma formation
                        </button>


                    </form>
                    <p class="text-center text-gray-500 text-xs">
                        &copy;2020 Acme Corp. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
