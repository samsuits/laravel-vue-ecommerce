import { defineConfig } from "cypress";

export default defineConfig({
  e2e: {
      "excludeSpecPattern": ["**/1-getting-started/*", "**/2-advanced-examples"],
    setupNodeEvents(on, config) {
      // implement node event listeners here
    },
  },

  component: {
    devServer: {
      framework: "vue",
      bundler: "vite",
    },
  },
});
