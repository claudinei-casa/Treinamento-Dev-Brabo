<template>
  <v-container>
    <Servicos :servicos="serviceData" />
  </v-container>
</template>

<script>
import Servicos from '~/components/globals/Servicos'
export default {
  components: { Servicos },

  async asyncData({ $axios }) {
    const serviceRes = await $axios.get('service')
    return {
      serviceData: serviceRes.data.servicos,
    }
  },
}
</script>
