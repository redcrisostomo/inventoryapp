<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import FormTextArea from '@/Components/FormTextArea.vue';
import FormSelect from '@/Components/FormSelect.vue';
import { Head, useForm} from '@inertiajs/vue3';
import { ref, reactive } from 'vue';
import BackBtn from '@/Components/BackBtn.vue';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

let images = reactive([]);
let formStep = ref(1);
let props = defineProps({
    categories: Object,
});
let form = useForm({
    name: '',
    description: '',
    category_id: '',
    product_images: '',
    date_available: '',
});
const firstStep = () => {
    form.post(route('products.first.step'), {
        onSuccess: () => formStep.value = 2,
    });
}
const secondStep = () => {
    form.post(route('products.second.step'), {
        onSuccess: () => formStep.value = 3,
    });
}
const submit = () => {
    form.post(route('products.store'), {
        onSuccess: () => form.reset(),
    });
}
const onFileChange = (e) => {
    const files = e.target.files;
    for(var x = 0; x<files.length; x++ )
    {
        images.push({
            'src' : URL.createObjectURL(e.target.files[x]),
        });
    }
    // Array.from(files).forEach((item) => {

    // });
    // url.value = URL.createObjectURL(file);
}
</script>
<template>
    <AdminLayout
        :header="'Create Product'"
        :description="'Create new product'"
    >
        <Head title="Create Product" />
        <div>
            <form @submit.prevent enctype="multipart/form-data">
                <div class="grid sm:grid-cols-1 lg:grid-flow-row-dense grid-cols-1 gap-4">
                    <div class="sm:flex-w-full lg:col-span-1 bg-white overflow-hidden shadow-sm sm:rounded-md p-6">
                        <div v-if="formStep==1">
                            <div>
                                <InputLabel for="name" value="Name" />
                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    :class="form.errors.name ? 'ring-2 ring-red-300' : ''"
                                    v-model="form.name"
                                    autofocus
                                    autocomplete="name"
                                />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                            <div class="mt-4">
                                <InputLabel for="category_id" value="Category" />
                                <FormSelect v-model="form.category_id" class="w-full mt-1" :class="form.errors.category_id ? 'ring-2 ring-red-300' : ''">
                                    <option :value="''"></option>
                                    <option v-for="( category_name, category_id ) in categories" :key="category_id" :value="category_id">
                                        {{ category_name }}
                                    </option>
                                </FormSelect>
                                <InputError class="mt-1" :message="form.errors.category_id" />
                            </div>
                            <div class="mt-4">
                                <InputLabel for="description" value="Description" />
                                <FormTextArea
                                    id="description"
                                    class="mt-1 block w-full"
                                    v-model="form.description"
                                    autofocus
                                />
                                <InputError class="mt-1" :message="form.errors.description" />
                            </div>
                            <div class="flex items-center justify-end mt-4 space-x-1">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="firstStep">
                                    Next
                                </PrimaryButton>
                                <BackBtn :href="$page.props.prevURL" :withIcon="true" :darktheme="true" :value="'Cancel'" />
                            </div>
                        </div>
                        <div v-if="formStep==2">
                            <h6 class="md:min-w-full text-gray-500 text-xs uppercase font-bold tracking-wide block pb-1 no-underline">Product Image</h6>
                            <div class="mt-4 h-56 border-2 border-gray-200 rounded p-1" id="imagePreview">
                                <div v-if="images" class="flex space-x-2 justify-center">
                                    <div v-for="image in images" :key="image.src" class="h-48">
                                        <img class="relative h-full" :src="image.src" />
                                    </div>
                                </div>
                                <span v-else class="italic text-sm text-gray-600">Preview Image here..</span>
                            </div>
                            <div class="mt-4">
                                <input @change="onFileChange"
                                    id="product_image"
                                    type="file"
                                    name="product_image"
                                    accept="image/*"
                                    @input="form.product_images = $event.target.files"
                                    class="mt-1 block w-full"
                                    multiple
                                />
                                <InputError class="mt-2" :message="form.errors.product_images" />
                            </div>
                            <div class="flex items-center justify-end mt-4 space-x-1">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="secondStep">
                                    Next
                                </PrimaryButton>
                                <!-- <BackBtn :href="$page.props.prevURL" :withIcon="true" :darktheme="true" :value="'Cancel'" /> -->
                            </div>
                        </div>
                        <div v-if="formStep==3" class="grid lg:w-1/2 mx-auto">
                            <div class="relative h-80">
                                <InputLabel for="date_available" value="Date Available" />
                                <div class="w-full">
                                    <Datepicker v-model="form.date_available" class="absolute"/>
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-16 space-x-1">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="submit">
                                    Submit
                                </PrimaryButton>
                                <!-- <BackBtn :href="$page.props.prevURL" :withIcon="true" :darktheme="true" :value="'Back'" /> -->
                            </div>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </AdminLayout>
</template>
