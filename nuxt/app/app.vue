<script setup lang="ts">
  const x_request_id = 'X-Request-ID'
</script>
<template>
  <div class="intro">
    <h1>Hello to this {{ x_request_id }} example</h1>
  </div>
</template>
<style>
body {
  background-color: #f2fff2;
}
.intro {
  text-align: center;
}
</style>
