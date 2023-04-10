<script setup>
let props = defineProps({
    src: String,
    value: String,
})
const showImage = () => {
    swal({
        //  icon: "/" + props.src + "",
         content: {
            element: "img",
            attributes: {
                src: props.src,
                style: "margin:auto; height:24rem; width:24rem; object-fit:cover;",
            },
        },
        button: "Close",
    });
 }
</script>
<template>
    <button @click="showImage()" title="Click to view larger image">
        <span v-if="value" class="text-indigo-700 text-sm uppercase tracking-widest">{{ value }}</span>
        <slot v-else />
    </button>
</template>
