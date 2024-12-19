<script lang="ts">
import { defineComponent, PropType, ref } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

interface Product {
  id: number;
  product_name: string;
  product_price: number;
  product_qty: number;
  product_img: string;
  product_code: string;
  product_description: string;
}
const user = usePage().props.auth.user;
export default defineComponent({
  props: {
    product: {
      type: Object as PropType<Product>,
      required: true,
    },
  },
  emits: ['update-quantity'],
  setup(props, { emit }) {
    const showModal = ref(false);
    const cartItems = ref<Product[]>([]);
    const quantity = ref(1);

    const addToCart = () => {
      const itemIndex = cartItems.value.findIndex(item => item.id === props.product.id);
      if (itemIndex !== -1) {
        cartItems.value[itemIndex].product_qty += quantity.value;
      } else {
        cartItems.value.push({ ...props.product, product_qty: quantity.value });
      }
      emit('update-quantity', cartItems.value);
      showModal.value = true;
      setTimeout(() => {
        showModal.value = false;
      }, 2000); // Hide modal after 2 seconds
    };

    const incrementQuantity = () => {
      quantity.value++;
    };

    const decrementQuantity = () => {
      if (quantity.value > 1) {
        quantity.value--;
      }
    };

    const proceedToCheckout = () => {
        alert(user.id)
  const data = cartItems.value.map(item => ({
    user_id: user.id,
    name_order: item.product_name,
    order_qty: item.product_qty,
    price_product: item.product_price,
    product_id: item.id,
  }));

  data.forEach(order => {
    router.post('/constomer/account/checkout', order, {
      onSuccess: () => {
        alert('Order placed successfully!');
      },
      onError: (errors) => {
        console.error(errors);
      },
    });
  });
};

    return {
      addToCart,
      showModal,
      cartItems,
      quantity,
      incrementQuantity,
      decrementQuantity,
      proceedToCheckout,
    };
  },
});
</script>

<template>
  <div class="border rounded-lg shadow-md overflow-hidden bg-white">
    <img :src="`/storage/${product.product_img}`" alt="Product Image" class="w-full h-48 object-cover" />
    <div class="p-4">
      <h3 class="text-lg font-bold text-gray-800">{{ product.product_name }}</h3>
      <p class="text-gray-600">{{ product.product_description }}</p>
      <div class="mt-4 flex justify-between items-center">
        <span class="text-xl font-semibold text-green-600">${{ product.product_price }}</span>
        <div class="flex items-center space-x-2">
          <button @click="decrementQuantity" class="px-3 py-1 bg-gray-200 text-gray-800 rounded">-</button>
          <span class="text-lg">{{ quantity }}</span>
          <button @click="incrementQuantity" class="px-3 py-1 bg-gray-200 text-gray-800 rounded">+</button>
        </div>
        <button
          @click="addToCart"
          class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
        >
          Add to Cart
        </button>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg">
      <h2 class="text-lg font-semibold text-gray-800">Item added to your cart!</h2>
      <h2 class="flex items-center">Product Quantity: {{ quantity }}</h2>
      <button
        @click="proceedToCheckout"
        class="mt-4 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600"
      >
        Proceed to Checkout
      </button>
    </div>
  </div>
</template>

<style scoped>
.fixed {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 50;
}
</style>
