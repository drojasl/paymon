<template>
  <div class="home">
    <div class="container">
      <h1>Welcome to PayMont Learning Platform</h1>
      <div class="buttons">
        <a href="/admin/courses" class="btn btn-primary">Admin Site</a>
        <a href="/user" class="btn btn-secondary">User Site</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Home"
};
</script>

<style scoped>
.home {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  text-align: center;
}

.container {
  width: 100%;
  max-width: 600px;
}

.buttons {
  display: flex;
  justify-content: space-around;
  margin-top: 20px;
}

.btn {
  padding: 10px 20px;
  text-decoration: none;
  color: white;
  border-radius: 5px;
  transition: background-color 0.3s;
}

.btn:hover {
  opacity: 0.8;
}

.btn-primary {
  background-color: #007bff;
}

.btn-secondary {
  background-color: #6c757d;
}
</style>
