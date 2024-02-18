<form id="checkout-form" class="relative z-10" aria-labelledby="slide-over-title" role="dialog" aria-modal="true" action="{{ route('place.order') }}" method="POST">
    @csrf
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity duration-300 ease-in-out" id="cart-backdrop"
        style="display: none;"></div>
    <div id="cart-modal"
        class="fixed inset-y-0 right-0 flex max-w-full pl-10 transform transition-transform translate-x-full duration-300 ease-in-out ">
        <div class="relative flex-1 flex flex-col max-w-md w-screen bg-white shadow-xl">
            <div class="flex items-start justify-between p-4 border-b border-gray-200 bg-gray-100">
                <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Shopping Cart</h2>
                <button type="button" class="text-gray-500 hover:text-gray-600" onclick="closeCartModal()">
                    <span class="sr-only">Close panel</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="mt-8 px-6">
                <div class="flow-root">
                    <ul role="list" class="-my-6 divide-y divide-gray-200">
                        @if (!empty($cartItems))
                            <ul>
                                @foreach ($cartItems as $id => $cartItem)
                                    <li id="item-{{ $id }}" class="flex py-6 cart-item"
                                        data-item-id="{{ $id }}">
                                        <div
                                            class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                            <img src="{{ asset('assets/images/' . $cartItem['image_url']) }}"
                                                alt="{{ $cartItem['item_name'] }}"
                                                class="h-full w-full object-cover object-center">
                                        </div>

                                        <div class="ml-4 flex flex-1 flex-col">
                                            <div>
                                                <div class="flex justify-between text-base font-medium text-gray-900">
                                                    <h3>
                                                        <a href="#">{{ $cartItem['item_name'] }}</a>
                                                    </h3>
                                                    <p class="ml-4">
                                                        Rp{{ number_format($cartItem['price'], 0, ',', '.') }}</p>
                                                </div>
                                                <p class="mt-1 text-sm text-gray-500">{{ $cartItem['weight'] }} Kg</p>
                                            </div>
                                            <div class="flex flex-1 items-end justify-between text-sm">
                                                <div class="flex items-center">
                                                    <button type="button"
                                                        class="font-medium text-indigo-600 hover:text-indigo-500"
                                                        onclick="decrementQuantity({{ $id }})">-</button>
                                                    <p id="quantity{{ $id }}" class="quantity mx-2">
                                                        {{ $cartItem['quantity'] }}</p>
                                                    <button type="button"
                                                        class="font-medium text-indigo-600 hover:text-indigo-500"
                                                        onclick="incrementQuantity({{ $id }})">+</button>
                                                </div>
                                                <button type="button"
                                                    class="font-medium text-red-600 hover:text-red-500"
                                                    onclick="removeItem({{ $id }})">Remove</button>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>Your cart is empty.</p>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="absolute bottom-0 left-0 w-full border-t border-gray-200 bg-white px-4 py-4 sm:px-6">
                <div id="subtotal" class="flex justify-between text-base font-medium text-gray-900">
                    <p>Subtotal</p>
                    <p>0</p>
                </div>
                <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                <div class="mt-6">
                    <button type="submit"
                        class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 w-full">Checkout</button>
                </div>
                <div class="mt-2 flex justify-center text-center text-sm text-gray-500">
                    <p>
                        or
                        <button onclick="closeModal()" type="button" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Continue Shopping <span aria-hidden="true">&rarr;</span>
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</form>

<button type="button"
    class=""
    onclick="openCartModal()">
    <svg class="text-gray-300 hover:text-white h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
            stroke="currentColor" stroke-width="1.5" />
        <path
            d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
            stroke="currentColor" stroke-width="1.5" />
        <path
            d="M2.26121 3.09184L2.50997 2.38429H2.50997L2.26121 3.09184ZM2.24876 2.29246C1.85799 2.15507 1.42984 2.36048 1.29246 2.75124C1.15507 3.14201 1.36048 3.57016 1.75124 3.70754L2.24876 2.29246ZM4.58584 4.32298L5.20507 3.89983V3.89983L4.58584 4.32298ZM5.88772 14.5862L5.34345 15.1022H5.34345L5.88772 14.5862ZM20.6578 9.88275L21.3923 10.0342L21.3933 10.0296L20.6578 9.88275ZM20.158 12.3075L20.8926 12.4589L20.158 12.3075ZM20.7345 6.69708L20.1401 7.15439L20.7345 6.69708ZM19.1336 15.0504L18.6598 14.469L19.1336 15.0504ZM5.70808 9.76V7.03836H4.20808V9.76H5.70808ZM2.50997 2.38429L2.24876 2.29246L1.75124 3.70754L2.01245 3.79938L2.50997 2.38429ZM10.9375 16.25H16.2404V14.75H10.9375V16.25ZM5.70808 7.03836C5.70808 6.3312 5.7091 5.7411 5.65719 5.26157C5.60346 4.76519 5.48705 4.31247 5.20507 3.89983L3.96661 4.74613C4.05687 4.87822 4.12657 5.05964 4.1659 5.42299C4.20706 5.8032 4.20808 6.29841 4.20808 7.03836H5.70808ZM2.01245 3.79938C2.68006 4.0341 3.11881 4.18965 3.44166 4.34806C3.74488 4.49684 3.87855 4.61727 3.96661 4.74613L5.20507 3.89983C4.92089 3.48397 4.54304 3.21763 4.10241 3.00143C3.68139 2.79485 3.14395 2.60719 2.50997 2.38429L2.01245 3.79938ZM4.20808 9.76C4.20808 11.2125 4.22171 12.2599 4.35876 13.0601C4.50508 13.9144 4.79722 14.5261 5.34345 15.1022L6.43198 14.0702C6.11182 13.7325 5.93913 13.4018 5.83723 12.8069C5.72607 12.1578 5.70808 11.249 5.70808 9.76H4.20808ZM10.9375 14.75C9.52069 14.75 8.53763 14.7482 7.79696 14.6432C7.08215 14.5418 6.70452 14.3576 6.43198 14.0702L5.34345 15.1022C5.93731 15.7286 6.69012 16.0013 7.58636 16.1283C8.45674 16.2518 9.56535 16.25 10.9375 16.25V14.75ZM4.95808 6.87H17.0888V5.37H4.95808V6.87ZM19.9232 9.73135L19.4235 12.1561L20.8926 12.4589L21.3923 10.0342L19.9232 9.73135ZM17.0888 6.87C17.9452 6.87 18.6989 6.871 19.2937 6.93749C19.5893 6.97053 19.8105 7.01643 19.9659 7.07105C20.1273 7.12776 20.153 7.17127 20.1401 7.15439L21.329 6.23978C21.094 5.93436 20.7636 5.76145 20.4632 5.65587C20.1567 5.54818 19.8101 5.48587 19.4604 5.44678C18.7646 5.369 17.9174 5.37 17.0888 5.37V6.87ZM21.3933 10.0296C21.5625 9.18167 21.7062 8.47024 21.7414 7.90038C21.7775 7.31418 21.7108 6.73617 21.329 6.23978L20.1401 7.15439C20.2021 7.23508 20.2706 7.38037 20.2442 7.80797C20.2168 8.25191 20.1002 8.84478 19.9223 9.73595L21.3933 10.0296ZM16.2404 16.25C17.0021 16.25 17.6413 16.2513 18.1566 16.1882C18.6923 16.1227 19.1809 15.9794 19.6074 15.6318L18.6598 14.469C18.5346 14.571 18.3571 14.6525 17.9744 14.6994C17.5712 14.7487 17.0397 14.75 16.2404 14.75V16.25ZM19.4235 12.1561C19.2621 12.9389 19.1535 13.4593 19.0238 13.8442C18.9007 14.2095 18.785 14.367 18.6598 14.469L19.6074 15.6318C20.0339 15.2842 20.2729 14.8346 20.4453 14.3232C20.6111 13.8312 20.7388 13.2049 20.8926 12.4589L19.4235 12.1561Z"
            fill="currentColor" />
    </svg>
    <span class="sr-only">Open shopping cart</span>
</button>

<script>
    function openCartModal() {
        document.getElementById('cart-modal').classList.remove('translate-x-full');
        document.getElementById('cart-modal').classList.add('translate-x-0');
        document.getElementById('cart-backdrop').style.display = 'block';

        updateSubtotal();
    }

    function closeCartModal() {
        document.getElementById('cart-modal').classList.remove('translate-x-0');
        document.getElementById('cart-modal').classList.add('translate-x-full');
        document.getElementById('cart-backdrop').style.display = 'none';
    }

    function incrementQuantity(itemId) {
        let quantityElement = document.getElementById(`quantity${itemId}`);
        let quantity = parseInt(quantityElement.textContent);
        quantity++;
        quantityElement.textContent = quantity;

        updateCart(itemId, quantity);
        updateSubtotal();
    }

    function decrementQuantity(itemId) {
        let quantityElement = document.getElementById(`quantity${itemId}`);
        let quantity = parseInt(quantityElement.textContent);
        if (quantity > 1) {
            quantity--;
            quantityElement.textContent = quantity;

            updateCart(itemId, quantity);
            updateSubtotal();
        }
    }

    function removeItem(itemId) {
        let itemElement = document.getElementById(`item-${itemId}`);
        itemElement.remove();

        removeCartItem(itemId);
        updateSubtotal();
    }

    function updateCart(itemId, quantity) {
        fetch(`/cart/update/${itemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    quantity: quantity
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to update cart');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function removeCartItem(itemId) {
        fetch(`/cart/remove/${itemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to remove item from cart');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function updateSubtotal() {
        fetch('/cart/subtotal')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch subtotal');
                }
                return response.json();
            })
            .then(data => {
                const subtotalElement = document.getElementById('subtotal');
                subtotalElement.innerHTML = `
                <p>Subtotal</p>
                <p>Rp${data.subtotal.toLocaleString('id-ID')}</p>
            `;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
