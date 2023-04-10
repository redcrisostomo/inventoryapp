<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import {onMounted} from 'vue';
import VideoJSPlayer from '@/Components/VideoJSPlayer.vue';
defineProps({
    videoOptions: {
        type: Object,
        default: {
            autoplay: true,
            controls: true,
            preload: true,
            fluid: true,
            sources: [
                {
                src:
                    '/upload/videos/pexels-cottonbro-studio.mp4',
                    // 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
                    type: 'video/mp4'
                }
            ]
        }
    }
});


</script>

<template>
    <AdminLayout
        :header="'Sample Video'"
        :description="''"
    >
        <Head title="Sample Videos" />
        <div class="sm:w-full lg:w-3/4 mx-auto bg-white overflow-hidden shadow-sm sm:rounded-md p-6">
       <VideoJSPlayer :options="videoOptions" />
    </div>
    </AdminLayout>
 </template>
