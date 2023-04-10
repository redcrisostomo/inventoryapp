<script setup>
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3'
import  debounce  from 'lodash/debounce';

let props = defineProps({
    searchUrl: String,
    filters: Object
 });

let search = ref(props.filters.search);

watch(search, debounce(function (value) {
    router.get(props.searchUrl, { search: value }, { preserveState: true, replace: true });
}, 500));
</script>

<template>
    <form @submit.prevent >
        <input v-model="search" type="text" placeholder="Search..." class="border px-2 rounded text-sm" @submit.prevent/>
    </form>
</template>
