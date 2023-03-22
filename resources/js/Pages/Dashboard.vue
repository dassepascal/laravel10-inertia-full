<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    title: null,
    description: null,
});



export default {
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
        submit() {
            form.post(route('courses.store'));
        },
        add() {
            this.episodes.push({
                title: null,
                description: null,
                video_url: null,
            })
        },
        remove() {
            this.episodes.pop();
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
                        </div>


                            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                Description de la formation
                            </label>
                            <textarea
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="description" type="text" v-model="form.description"></textarea>


                        <div class="mb-4">
                            <h2 class="text-2xl">Episodes de la formation</h2>
                            <div v-for="(episode, index) in episodes  " v-bind:key="index">
                                <label class="block text-gray-700 text-sm font-bold mb-2" :for="'title-' + index">
                                    Titre de l'episode n°{{ index + 1 }}
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    type="text" :id="'title -' + index" v-model="episodes[index].title">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" :for="'description-' + index">
                                        Description de l'episode n°{{ index + 1 }}
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        type="text" :id="'description -' + index" v-model="episodes[index].description">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" :for="'video_url-' + index">
                                        Url de l'episode n°{{ index + 1 }}
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-5"
                                        type="text" :id="'video_url -' + index" v-model="episodes[index].video_url">
                            </div>
                        </div>
                        <!-- ne pas oublier le prevent sinon le formulaire va être renvoyer à chaqu fois -->
                        <button class="bg-green-600 rounded py-4 px-4 my-2 text-white  block" v-if="episodes.length < 15" @click.prevent="add">+
                        </button>
                        <button class="bg-red-600 rounded py-4 px-4 my-2 text-white  block" v-if="episodes.length > 1" @click.prevent="remove">    🗑️                     </button>

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
