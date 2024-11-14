<template>
    <h2>Video Manager</h2>
    <div>
      <form @submit.prevent="submitForm">
        <div>
          <label for="title">Title</label>
          <input
            type="text"
            id="title"
            v-model="title"
            class="border p-2 w-full mt-1"
            required
          />
        </div>
        <div>
          <label for="description">Description</label>
          <textarea
            id="description"
            v-model="description"
            class="border p-2 w-full mt-1"
            required
          ></textarea>
        </div>
        <div>
          <label for="url">Video URL</label>
          <input
            type="url"
            id="url"
            v-model="url"
            class="border p-2 w-full mt-1"
            required
          />
        </div>
        <div>
          <label for="category">Category</label>
          <select
            id="category"
            v-model="category"
            class="border p-2 w-full mt-1"
            required
          >
            <option v-for="cat in categories" :key="cat.id" :value="cat.id">
              {{ cat.name }}
            </option>
          </select>
        </div>
        <div>
            <v-btn
                type="submit"
                color="primary"
                class="mt-4"
                :disabled="isSubmitting"
            >
                Add Video
            </v-btn>
        </div>
      </form>
  
      <div>
        <h3>Course Videos</h3>
        <table class="table-auto w-full mt-6">
          <thead>
            <tr>
              <th class="border px-4 py-2">Title</th>
              <th class="border px-4 py-2">Description</th>
              <th class="border px-4 py-2">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="video in videos" :key="video.id">
              <td class="border px-4 py-2">
                <a :href="video.url" target="_blank" class="text-blue-500">
                  {{ video.title }}
                </a>
              </td>
              <td class="border px-4 py-2">{{ video.description }}</td>
              <td class="border px-4 py-2">
                <v-btn @click="deleteVideo(video.id)" color="red" icon>
                    <v-icon>mdi-delete</v-icon>
                </v-btn>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script>
  import { ref } from "vue";
  import { CourseService } from "@/services/courseService";
  
  export default {
    props: {
      course: {
        type: Object,
        required: true,
      },
      categories: {
        type: Array,
        required: true,
      },
    },
    setup(props) {
      const title = ref("");
      const description = ref("");
      const url = ref("");
      const category = ref(null);
      const categories = ref(props.categories);
      const videos = ref([]);
      const loading = ref(false);
  
      const submitForm = async () => {
        loading.value = true;
        try {
          await CourseService.createCourseVideo(props.course.id, {
            title: title.value,
            description: description.value,
            url: url.value,
            category: category.value,
          });
          title.value = "";
          description.value = "";
          url.value = "";
          category.value = null;
          fetchVideos();
        } catch (error) {
          console.error("Error creating video:", error);
        } finally {
          loading.value = false;
        }
      };
  
      const fetchVideos = async () => {
        try {
          const response = await CourseService.getCourseVideos(props.course.id);
          videos.value = response.data;
        } catch (error) {
          console.error("Error fetching videos:", error);
        }
      };
  
      const deleteVideo = async (id) => {
        try {
          await CourseService.deleteCourseVideo(id);
          fetchVideos();
        } catch (error) {
          console.error("Error deleting video:", error);
        }
      };
  
      fetchVideos();
  
      return {
        title,
        description,
        url,
        category,
        categories,
        videos,
        loading,
        submitForm,
        deleteVideo,
      };
    },
  };
  </script>
  
  <style scoped>
  form {
    max-width: 600px;
    margin: 0 auto;
  }
  
  div {
    margin-bottom: 16px;
  }
  
  label {
    display: block;
    margin-bottom: 8px;
  }
  
  input,
  textarea,
  select {
    width: 100%;
    padding: 10px;
    margin-top: 4px;
    border: 2px solid #ccc;
    border-radius: 4px;
  }
  
  button:disabled {
    background-color: #cccccc;
    cursor: not-allowed;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
  }
  
  table th,
  table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }
  
  table th {
    background-color: #f4f4f4;
  }
  </style>
  