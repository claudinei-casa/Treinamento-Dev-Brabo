<template>
  <v-container
    ><p>Voce pode começar fazendo alguns card aqui!!!</p>
    <v-card v-for="serv in servicos" :key="serv">
      <p>{{ serv.service }}</p>
    </v-card>
  </v-container>
</template>
<script>
export default {
  name: 'Servicos',
  props: {
    servicos: {
      type: Array,
      require: true,
      default: () => {},
    },
  },
  // async asyncData({ $axios }) {
  //   const serviceRes = await $axios.get('service')
  //   return {
  //     serviceData: serviceRes.data.servicos,
  //   }
  // },
}
</script>
