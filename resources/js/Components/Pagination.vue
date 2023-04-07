<template>
    <v-pagination
      v-model="page"
      :pages="10"
      :range-size="1"
      active-color="#DCEDFF"
      @update:modelValue="updateHandler"
    />
</template>

<script>
import VPagination from "@hennge/vue3-pagination";
import "@hennge/vue3-pagination/dist/vue3-pagination.css";
let page = ref(1);
export default {


  components: {
    VPagination
  },

}
</script>
