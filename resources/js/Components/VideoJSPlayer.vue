<script setup>
import { onMounted, ref, reactive } from 'vue';
import videojs from 'video.js';

let props = defineProps({
    options: {
        type: Object,
        default: {},
    },
});


let player = reactive({});
const videoJSPlayer = ref(null);

onMounted(() => {
    player = videojs(videoJSPlayer.value, props.options,() => {
         player.log('video player ready', this);
      });
});

</script>

<template>
    <div>
       <video ref="videoJSPlayer" class="video-js vjs-defaultskin" data-setup="{}"></video>
    </div>
 </template>


