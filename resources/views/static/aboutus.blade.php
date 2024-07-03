

@section('content')

<h1>Welcome to Petopia Store - Your Pet's Paradise Unleashed!</h1>

<p>In the enchanting realm of Petopia Store, we extend a heartfelt invitation to all pet enthusiasts and their cherished companions. Born out of a passion for pampering our furry friends, Petopia is not just an online shop; it's a haven meticulously crafted to cater to the diverse needs of pets and their discerning owners.</p>

<h2>Tailored for Every Pet, Every Owner:</h2>
<p>Petopia Store is a pet-centric universe designed to cater to the unique needs of all types of pets and their guardians. With a keen understanding of the special bond shared between pets and their owners, our platform is a seamless blend of functionality and aesthetic appeal, ensuring an inclusive and delightful experience for a broad spectrum of users.</p>

<h2>A Cornucopia of Choices:</h2>
<p>Dive into our extensive selection of premium animal care and food products, thoughtfully curated to meet the highest standards of quality and nutritional excellence. Navigating through our digital aisles is a breeze, thanks to user-friendly filters and categories that transform your shopping journey into a personalized exploration.</p>

<h2>Anytime, Anywhere Accessibility:</h2>
<p>Petopia Store is not confined to a physical space – it's wherever you and your internet-connected device are! With accessibility at the forefront, our platform is designed to be seamlessly experienced on demand across various devices, allowing you to embark on a pet-centric shopping adventure whenever and wherever you desire.</p>

<h2>Effortless Shopping Experience:</h2>
<p>Choose from an array of offers, employing our intuitive filters and categories for a tailored shopping experience. Save your favorites or add items to your shopping cart with ease, creating a wishlist that can be revisited at your convenience, especially if you choose to create an account with us.</p>

<h2>Secure Transactions, Transparent Tracking:</h2>
<p>Petopia Store prioritizes your peace of mind. With a plethora of payment options to suit your preferences, rest assured that your transactions are secure. Enjoy the convenience of detailed tracking for your orders, ensuring that you are in the loop every step of the way.</p>

<h2>Shopping History at Your Fingertips:</h2>
<p>Keep track of your pet's preferences with a detailed shopping history, available at your fingertips. This feature allows you to revisit past purchases, ensuring a seamless and personalized shopping experience tailored to your pet's evolving needs.</p>

<h2>Connect With Us:</h2>
<ul>
    <li>Email: <a href="mailto:support@petopiastore.com">support@petopiastore.com</a></li>
    <li>Phone: +1234567890</li>
    <li>Address: 123 Pet Street, Porto, Portugal</li>
</ul>

@endsection

@if(Auth::user() && Auth::user()->isAdmin())
    @include('layouts.admin_app')
@else
    @include('layouts.app')
@endif