<template>
  <div class="main-layout flex w-full md:max-w-5xl md:mx-auto rounded my-20 p-8 bg-indigo-50">
    <router-view v-slot="{ Component }">
      <transition name="page" mode="out-in">
        <component :is="Component" />
      </transition>
    </router-view>
  </div>
</template>

<script>
export default {
  name: 'MainLayout',

  components: {},

  computed: {},

  mounted () {},

  methods: {}
}
</script>