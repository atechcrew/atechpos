export default Vue.extend({
    props: ["data"],
    data() {
        return {
            items: [],
        }
    },
    methods: {
        add(item) {
            this.items.push(item)
            Event.fire('added', item)
        },

        setItem(data) {
            this.items = data
        },

        remove(index) {
            this.item.splice(this.items.indexOf(item), 1)
            Event.fire('removed', index)
        }

    }
})