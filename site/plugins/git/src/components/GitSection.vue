<template>
  <k-box class="k-git-section" theme="passive">
    <header class="k-section-header">
        <k-headline>{{ label }}</k-headline>
    </header>

    <k-input
        type="text"
        before="Commit message"
        :value="text"
        @input="text = $event"
    />

    <k-button
        icon="check"
        variant="filled"
        :disabled="loading || !text"
        @click="commit"
    >
        Commit
    </k-button>
     <k-button
        icon="check"
        variant="filled"
        :disabled="loading"
        @click="push"
    >
        Push
    </k-button>


    <pre v-if="output">{{ output }}</pre>
    <k-text theme="negative" v-if="error">{{ error }}</k-text>
    </k-box>
</template>

<script>
export default {
  data() {
    return {
      label: null,
      text: '',
      output: null,
      error: null,
      loading: false
    };
  },
  async created() {
    const response = await this.load();
    this.label = response.label;
  },
  methods: {
    async commit() {
      this.loading = true;
      this.error = null;
      try {
        const response = await this.$api.post('commit', { text: this.text });
        this.output = response.output;
      } catch (error) {
        this.error = error.message;
      } finally {
        this.loading = false;
      }
    },
    async push() {
      this.loading = true;
      this.error = null;
      try {
        const response = await this.$api.post('push', { });
        this.output = response.output;
      } catch (error) {
        this.error = error.message;
      } finally {
        this.loading = false;
      }
    }
  }
};
</script>
