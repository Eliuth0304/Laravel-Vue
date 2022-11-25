<template>
  <div class="flex mt-6">
    <div class="w-full md:w-2/3 md:mx-auto md:max-w-md">
      <h1 class="mb-4 font-semibold text-3xl text-gray-900">
        404 Page not found!
      </h1>
      <div class="links">
        <router-link :to="{ name: 'home' }" class="hover:underline text-gray-700">
          Go to Home
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NotFound'
}
</script>