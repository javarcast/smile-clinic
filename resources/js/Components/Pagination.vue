<template>
  <div v-if="links.length > 3">
    <div class="flex justify-end flex-wrap -mb-1 mt-2">
      <template v-for="(link, key) in links">
        <div v-if="link.url === null" :key="key" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
        <inertia-link v-else :class="{ 'bg-black': link.active , 'text-white':link.active,'bg-white': !link.active }" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border  rounded  focus:border-indigo-500 focus:text-indigo-500 "  :href="link.url" v-html="link.label" />
      </template>
    </div>
  </div>
</template>

<script>
import {InertiaLink} from "@inertiajs/inertia-vue3";

export default {
  props: {
    links: Array,
  },
  components : {
    InertiaLink
  }
}
</script>