<template>
    <div class="course-create-container">
      <h2>Create New Course</h2>
      <form @submit.prevent="submitForm" method="POST" action="{{ route('admin.courses.store') }}">
        <div class="form-group">
          <label for="name">Course Name</label>
          <input
            type="text"
            id="name"
            v-model="form.name"
            required
            placeholder="Enter course name"
          />
        </div>
  
        <div class="form-group">
          <label for="description">Description</label>
          <textarea
            id="description"
            v-model="form.description"
            required
            placeholder="Enter course description"
          ></textarea>
        </div>
  
        <div class="form-group">
          <label for="category">Category</label>
          <select id="category" v-model="form.category_id" required>
            <option value="" disabled>Select Category</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">
              {{ category.name }}
            </option>
          </select>
        </div>
  
        <div class="form-group">
          <label for="age_range">Age Range</label>
          <select id="age_range" v-model="form.age_range" required>
            <option value="5-8">5-8</option>
            <option value="9-13">9-13</option>
            <option value="14-16">14-16</option>
            <option value="16+">16+</option>
          </select>
        </div>
  
        <button type="submit" class="btn btn-primary">Create Course</button>
      </form>
  
      <div v-if="message" class="alert" :class="messageClass">
        {{ message }}
      </div>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  
  export default {
    props: {
      categories: {
        type: Array,
        required: true
      }
    },
    setup(props) {
      const form = ref({
        name: '',
        description: '',
        category_id: '',
        age_range: '5-8',
      });
  
      const message = ref('');
      const messageClass = ref('');
  
      const submitForm = async () => {
        try {
          const response = await axios.post('/admin/courses', form.value);
          message.value = 'Course created successfully!';
          messageClass.value = 'alert-success';
          form.value = {
            name: '',
            description: '',
            category_id: '',
            age_range: '5-8',
          };
        } catch (error) {
          message.value = 'Error creating course. Please try again.';
          messageClass.value = 'alert-danger';
        }
      };
  
      return { form, message, messageClass, submitForm };
    }
  };
  </script>
  
  <style scoped>
  .course-create-container {
    padding: 20px;
  }
  
  h2 {
    font-size: 24px;
    margin-bottom: 20px;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  label {
    display: block;
    font-weight: bold;
  }
  
  input,
  textarea,
  select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  
  button {
    margin-top: 20px;
  }
  
  .alert {
    margin-top: 20px;
    padding: 10px;
    border-radius: 4px;
  }
  
  .alert-success {
    background-color: #d4edda;
    color: #155724;
  }
  
  .alert-danger {
    background-color: #f8d7da;
    color: #721c24;
  }
  </style>
  