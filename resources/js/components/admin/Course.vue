<template>
  <v-container>
    <v-card class="pa-4 mb-4">
      <v-card-title class="text-h4">{{ course.name }}</v-card-title>

      <v-card-subtitle>Course Information</v-card-subtitle>
      <v-card-text>
        <v-row>
          <v-col cols="12" md="6">
            <p><strong>Description:</strong> {{ course.description }}</p>
          </v-col>
          <v-col cols="12" md="6">
            <p><strong>Category:</strong> {{ course.category.name }}</p>
          </v-col>
          <v-col cols="12" md="6">
            <p><strong>Age Range:</strong> {{ course.age_range }}</p>
          </v-col>
        </v-row>
      </v-card-text>

      <v-divider></v-divider>

      <v-card-subtitle>Registered Users</v-card-subtitle>
      <v-card-text>
        <v-list dense>
          <v-list-item v-for="user in users" :key="user.id">
            <v-list-item-content>{{ user.name }}</v-list-item-content>
          </v-list-item>
        </v-list>
      </v-card-text>

      <v-divider></v-divider>

      <v-card-subtitle>Course Videos</v-card-subtitle>
      <v-card-text>
        <v-list dense>
          <v-list-item v-for="video in videos" :key="video.id">
            <v-list-item-content>
              <v-list-item-title>
                <a :href="video.url" target="_blank" class="text-decoration-none text-primary">
                  {{ video.title }}
                </a>
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-card-text>

      <v-divider></v-divider>

      <v-card-actions>
        <v-btn color="primary" @click="goToVideoAdmin">
          Manage Videos
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-container>
</template>

<script>
import { ref, onMounted } from 'vue'
import { CourseService } from '@/services/CourseService'

export default {
  props: {
    course: {
      type: Object,
      required: true
    },
    users: {
      type: Array,
      required: true
    }
  },
  setup(props) {
    const course = props.course
    const users = props.users
    const videos = ref([])

    const loadCourseVideos = async () => {
      try {
        const response = await CourseService.getCourseVideos(course.id)
        videos.value = response.data
      } catch (error) {
        console.error('Error fetching course videos:', error)
      }
    }

    const goToVideoAdmin = () => {
      window.location.href = `/admin/courses/${course.id}/videos`
    }

    onMounted(() => {
      loadCourseVideos()
    })

    return { course, users, videos, goToVideoAdmin }
  }
}
</script>

<style scoped>
.text-primary {
  color: #1976d2;
}
.text-decoration-none {
  text-decoration: none;
}
</style>
