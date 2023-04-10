<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import CreateBtn from '@/Components/CreateBtn.vue';
import EditBtn from '@/Components/EditBtn.vue';
import DeleteBtn from '@/Components/DeleteBtn.vue';
import CategoryFilter from '@/Components/CategoryFilter.vue';
import { ref, onMounted } from 'vue';

let counter = ref(0);
let props = defineProps({
    products: Object,
    categories: Object,
    filters : Object,
    category_id: [String, Number],
 });
 onMounted(() => {
    counter.value = ((props.products.current_page -1) * props.products.per_page) + 1;
 });
</script>
<template>
    <Head title="Products" />

    <AdminLayout
        :header="'Products'"
        :description="'List of all products'"
        :searchUrl="'/products'"
        :filters="filters"
    >
        <template #action>
            <CreateBtn :href="route('products.create')" :value="'Create Product'" />
        </template>
        <CategoryFilter :filters="filters" :filterUrl="route('products.index')" :categories="categories" :default="category_id" />
        <div class="w-full bg-white overflow-hidden shadow-sm sm:rounded-md p-6">
            <table class="table table-auto text-sm w-full">
                <thead>
                    <tr>
                        <th class="border p-4">#</th>
                        <th class="border p-4">Image</th>
                        <th class="border p-4">Name</th>
                        <th class="border p-4">ID</th>
                        <th class="border p-4">Description</th>
                        <th class="border p-4">Category</th>
                        <th class="border p-4">Date Launch</th>
                        <th class="border p-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in products.data" :key="item.id">
                        <td class="border p-2">{{ counter+index }}</td>
                        <td class="border p-1 text-center">
                            <div v-if="item.images" class="flex flex-wrap">

                                <img v-for="image in item.images" :key="image.file" :src="'/'+image.file" class="h-12 w-12" />
                            </div>
                        </td>
                        <td class="border p-2">{{ item.name }}</td>
                        <td class="border p-2">{{ item.id }}</td>
                        <td class="border p-2">{{ item.description }}</td>
                        <td class="border p-2">{{ item.category.name }}</td>
                        <td class="border p-2">{{ item.date_available }}</td>
                        <td class="border p-2">
                            <div class="space-x-1 flex justify-center">
                                <EditBtn :href="route('products.edit', item.id)" />
                                <DeleteBtn :href="route('products.destroy', item.id)" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination class="mt-6" :links="products.links" />
        </div>
    </AdminLayout>
</template>
