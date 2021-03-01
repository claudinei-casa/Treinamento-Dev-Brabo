<template>
  <v-app>
    <v-navigation-drawer v-model="drawer" app dark>
      <v-list>
        <v-list-item-group>
          <v-list-item v-for="(item, i) in items" :key="i" :to="item.link">
            <v-list-item-icon>
              <v-icon v-text="item.icon"></v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title v-text="item.text"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app dark>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>Painel do Administrador</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn @click="logout()"> Sair </v-btn>
    </v-app-bar>
    <v-content>
      <nuxt />
    </v-content>
    <v-footer app inset dark>
      <span class="white--text">&copy; Dev-Brabo</span>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    drawer: null,
    items: [
      {
        icon: 'mdi-check',
        text: 'Serviços',
        link: 'dashboard/Dashservicos',
      },
    ],
  }),
  methods: {
    async logout() {
      await this.$auth.logout()
      this.$router.push('/login')
    },
  },
  head() {
    return {
      title: 'Dashboard',
      meta: [
        {
          hid: 'description',
          name: 'description',
          content: 'Página para controlar o projeto base',
        },
      ],
    }
  },
}
</script>
