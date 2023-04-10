<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import swal from 'sweetalert';

let props = defineProps({
    href: {
        type: String,
        default: '',
    },
    value: {
        type: String,
        default: ''
    },
});
 let form = useForm({
    id:'',
 });
const confirmDelete = () => {
    swal({
        title: "Are you sure?",
        text: "You want to delete this record?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            form.delete(props.href);
        } else {
            return false;
        }
    });
};
</script>

<template>
    <form @submit.prevent="submit" >
        <button
                type="submit"
                class="inline-flex items-center bg-zinc-200 border border-zinc-400 rounded font-semibold text-xs text-zinc-600 tracking-widest hover:bg-zinc-300 focus:bg-zinc-300 active:bg-zinc-300 focus:outline-none focus:ring-1 focus:ring-zinc-600 focus:ring-offset-1 transition ease-in-out duration-150"
                :class="'py-2 px-2'"
                title="Delete Record"
                @click="confirmDelete"
            >
            <span v-if="value"> {{ value  }}</span>
            <i class="fa fa-trash text-sm" v-else></i>
        </button>
    </form>
</template>
