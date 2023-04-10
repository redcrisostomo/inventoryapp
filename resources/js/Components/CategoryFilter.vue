<script setup>
import { useForm } from '@inertiajs/vue3'
import FormSelect from '@/Components/FormSelect.vue';
import InputLabel from '@/Components/InputLabel.vue';
let props = defineProps({
    filterUrl: String,
    filters: Object,
    categories: Object,
    default: [String, Number],
});

let form = useForm({
    category : props.filters.category ?? props.default,
 });

const filter = () => {
    form.get(props.filterUrl, {
      replace: true,
    });
}
</script>

<template>
    <form @submit.prevent class="flex space-x-2 mb-2">
        <InputLabel for="category" value="Category" class="text-xs uppercase font-bold tracking-widest pt-3"/>
        <FormSelect v-model="form.category" placeholder="Select category" @change="filter">
            <option value="all">All</option>
            <option v-for="(category_name, category_id) in categories" :key="category_id" :value="category_id">{{ category_name }}</option>
        </FormSelect>
    </form>
</template>
