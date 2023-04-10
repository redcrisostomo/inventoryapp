<script setup>
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import SubMenu from '@/Components/MultilevelMenu/SubMenu.vue';
import { computed, onMounted, ref } from 'vue';
const props = defineProps({
    label: String,
    links: Object,
});
const isOpen = ref(false);
const hasChildActive = ref(false);

const toggle = () => {
    isOpen.value = !isOpen.value;
}
onMounted(() => {
    isOpen.value = false;
    hasChildActive.value = false;
    for(let i = 0;i < props.links.length; i++ ) {
         if(route().current(props.links[i].route_name))
         {
            isOpen.value = true;
            hasChildActive.value = true;
         }
    }
});

</script>
<template>
    <div class="relative text">
        <button @click="toggle" as="button"
            class="'text-sm block w-full pl-3 pr-4 py-2  text-left hover:text-gray-800 hover:text-indigo-700 hover:border-indigo-200 focus:outline-none focus:bg-gray-50  transition duration-150 ease-in-out'"
            :class="isOpen ? 'bg-gray-50' : (hasChildActive ? 'text-indigo-700 border-r-4 border-indigo-400' : 'text-gray-600 border-r-4 border-transparent focus:text-gray-800 focus:border-gray-300')"
            >
             <span class="text-sm">{{ props.label }}</span>
             <span class="float-right"><i class="fa fa-chevron-down text-sm"  :class="isOpen ? 'text-gray-400' : (hasChildActive ? 'text-indigo-700' : 'text-gray-400')"></i></span>
            </button>
            <div v-if="isOpen">
                <SubMenu v-for="link in props.links" :key="link.route_name" :routeName="link.route_name">
                    <span class="pl-2">{{ link.name }}</span>
                </SubMenu>
            </div>
        <slot />
    </div>
</template>

