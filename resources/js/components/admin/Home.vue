<template>
  <div>
    <h1>Admin Dashboard</h1>
    <div class="admin-options">
      <h3>Manage Courses</h3>
      <a href="/admin/courses" class="btn btn-primary">View and Manage Courses</a>
      
      <h3>Manage Videos</h3>
      <a href="/admin/videos" class="btn btn-primary">View and Manage Videos</a>

      <h3>Manage Users</h3>
      <a href="/admin/users" class="btn btn-primary">View Users Registered in Courses</a>

      <h3>Manage Comments</h3>
      <a href="/admin/comments" class="btn btn-primary">Approve/Reject Comments</a>

      <h3>Create New Course</h3>
      <button @click="openCreateCourseModal" class="btn btn-success">Create New Course</button>
    </div>

    <!-- Modal for Creating a New Course -->
    <div v-if="isCreateCourseModalOpen" class="modal">
      <div class="modal-content">
        <span @click="closeCreateCourseModal" class="close">&times;</span>
        <h2>Create New Course</h2>
        <form @submit.prevent="createCourse">
          <input v-model="newCourse.name" type="text" placeholder="Course Name" required />
          <textarea v-model="newCourse.description" placeholder="Course Description" required></textarea>
          <input v-model="newCourse.age_range" type="text" placeholder="Age Range" required />
          <input v-model="newCourse.category" type="text" placeholder="Category" required />
          <button type="submit" class="btn btn-success">Create Course</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isCreateCourseModalOpen: false,
      newCourse: {
        name: '',
        description: '',
        age_range: '',
        category: ''
      }
    };
  },
  methods: {
    openCreateCourseModal() {
      this.isCreateCourseModalOpen = true;
    },
    closeCreateCourseModal() {
      this.isCreateCourseModalOpen = false;
    },
    async createCourse() {
      // Logic to create a new course, for now just log the new course object
      console.log(this.newCourse);
      // Here you can make a POST request to the backend to create a course
      // await axios.post('/admin/courses', this.newCourse);
      
      // Reset form and close modal
      this.newCourse = {
        name: '',
        description: '',
        age_range: '',
        category: ''
      };
      this.closeCreateCourseModal();
    }
  }
};
</script>

<style scoped>
.admin-options {
  margin: 20px;
}

.admin-options .btn {
  margin: 10px 0;
}

.modal {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 5px;
  width: 400px;
}

.modal-content input, .modal-content textarea {
  width: 100%;
  margin-bottom: 10px;
  padding: 8px;
}

.close {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 30px;
  cursor: pointer;
}
</style>
