<template>
  <draggable class="dragArea" tag="div" :list="nodes">
    <div
      v-for="(node, index) in nodes"
      :key="index"
      :style="
        $i18n.locale == 'ar'
          ? 'margin-right:21px; text-align: right;'
          : 'margin-left:21px; text-align: left; '
      "
      :class="[$i18n.locale == 'ar' ? 'dir-node' : '', 'node']"
    >
      <span class="type" @click="nodeClicked(node)"
        ><i
          v-if="
            (node.children && node.children.length) ||
            (node.doc_type_field && node.doc_type_field.length)
          "
          :class="isExpanded(node) ? 'fas fa-minus' : 'fas fa-plus'"
        ></i
      ></span>
      <span
        :class="{ active:node == currentNode && depth == 1 }"
        :style="depth == 1 ? 'cursor:pointer' : ''"
        class="title-tree"
        @click="onNodeSelected(node)"
        @dblclick="onDoubleClicked(node)"
           >
        {{
          node.doc_field_id
            ? $i18n.locale == "ar"
              ? node.doc_field_id.name
              : node.doc_field_id.name_e
            : $i18n.locale == "ar"
            ? node.name
            : node.name_e
        }}
        <span v-if="depth==1">({{node.files_count}})</span>
      </span>
      <TreeBrowser
        v-if="
          isExpanded(node) &&
          (node.children || (node.doc_type_field && node.doc_type_field.length))
        "
        :nodes="
          node.doc_type_field && node.doc_type_field.length
            ? node.doc_type_field
            : node.children
        "
        :depth="depth + 1"
        @onClick="(node) => $emit('onClick',node)"
        @onDoubleClicked="(node) => $emit('onDoubleClicked',node)"
      />
    </div>
  </draggable>
</template>

<script>
import draggable from "vuedraggable";

export default {
  name: "TreeBrowser",
  props: {
    currentNode:Object,
    nodes: Array,
    depth: {
      type: Number,
      default: 0,
    },
  },
  data() {
    return {
      expanded: [],
    };
  },
  methods: {
    onNodeSelected(node){
      if(this.depth==1){
        this.$emit("onClick",node);
      }
    },
    isExpanded(node) {
      return this.expanded.indexOf(node) !== -1;
    },
    onDoubleClicked(node) {
      if (this.depth == 1) {
        this.$emit("onDoubleClicked", node);
      }
    },
    nodeClicked(node) {
      if (!this.isExpanded(node)) {
        this.expanded.push(node);
      } else {
        this.expanded.splice(this.expanded.indexOf(node));
      }
    },
  },
  components: {
    draggable,
  },
  computed: {},
};
</script>

<style scoped>
* {
  font-size: 16px;
}
.node {
  font-size: 18px;
}
.title-tree {
  font-size: 16px;
  font-weight: 500;
}

.type {
  margin-right: 10px;
}

/*ali*/

.node {
  --spacing: 1.5rem;
  --radius: 10px;
}

.node .node {
  display: block;
  position: relative;
  padding-left: calc(1.5 * var(--spacing) - var(--radius) - 2px);
}

.node .dragArea {
  margin-left: calc(var(--radius) - var(--spacing));
  padding-left: 0;
}

.node .dragArea .node {
  border-left: 2px solid #ddd;
}
.node .dragArea .node.dir-node {
  border-right: 2px solid #ddd;
  border-left: unset;
}

.node .dragArea .node:last-child {
  border-color: transparent;
}

.node .dragArea .node::before {
  content: "";
  display: block;
  position: absolute;
  top: calc(var(--spacing) / -2);
  left: -2px;
  width: calc(var(--spacing) + 2px);
  height: calc(var(--spacing) + 5px);
  border: solid #ddd;
  border-width: 0 0 2px 2px;
}

.node .dragArea .node.dir-node::before {
  content: "";
  display: block;
  position: absolute;
  top: calc(var(--spacing) / -2);
  right: -2px;
  width: 12px;
  height: calc(var(--spacing) + 5px);
  border: solid #ddd;
  border-width: 0 2px 2px 0;
  left: unset;
}

i {
  background-color: #3bafda;
  color: snow;
  border-radius: 50%;
  padding: 3px;
  font-size: 12px;
  margin: 0px;
  position: relative;
  z-index: 1;
}

.active {
  color: #159a80 !important;
}
</style>
