<template>
  <main>
    <div v-if="page">
      <h1 v-html="page.title.rendered"></h1>
      <div v-html="page.content.rendered"></div>
      <!-- <home-hero /> -->
      <ul>
        <li 
          v-for="(item, key) in layout_components" 
          :key="key">{{item}}</li>
      </ul>
      <pre>{{ layout_components }}</pre>
        <component :is="'HomeHero'" />
    </div>
  </main>
</template>

<script>
import HomeHero from "./Home/Hero.vue";
import BlogListing from "./Home/BlogListing.vue";

export default {
  name: 'PageContent',
  components: {
    HomeHero
  },
  props: {
    slug: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      request: {
        type: 'pages',
        slug: this.slug,
        showLoading: true 
      },
    }
  },
  computed: {
    page() {
      return this.$store.getters.singleBySlug(this.request)
    },
    layout_components() {
      return this.$store.state.components
    }
  },
  methods: {
    getPage () {
        this.$store.dispatch('getSingleBySlug', this.request).then(() => {
          if (this.page) {
            this.$store.dispatch('updateDocTitle', { parts: [ this.page.title.rendered, this.$store.state.site.name] })
          } else {
            this.$router.replace('/404')
          }
        })
      }
  },
  created () {
    this.getPage()
  }
}
</script>
