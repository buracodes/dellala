export default function About() {
  return (
    <div>
      {/* top */}
      <div className="w-full h-72 relative">
        <img
          src="https://cdn.pixabay.com/photo/2017/02/07/18/16/living-room-2046668_1280.jpg"
          alt="image"
          className="w-full h-full object-cover"
        />
      </div>

      <div className="max-w-6xl mx-auto p-5">
        <div className="flex flex-col md:flex-row">
          <div className="md:w-1/2 md:pl-10 mt-5 md:mt-0 mb-10 md:mr-5">
            <h1 className="text-4xl mb-5">About Us</h1>
            <p className="mb-5">
              Online Delala is a leading online platform for buying, selling, and renting properties. We are dedicated to providing a seamless and enjoyable experience for our users to find their dream properties.
            </p>
            <p className="mb-5">
              Our mission is to connect individuals and families with their ideal homes, whether they are looking to buy, sell, or rent. We strive to offer a wide range of property listings, from apartments and houses to commercial spaces and land.
            </p>
            <p className="mb-5">
              At Online Delala, we understand that finding the perfect property is a significant decision. That is why we provide comprehensive information, high-quality images, and advanced search features to help users make informed choices.
            </p>
          </div>
          <div className="md:w-1/2">
            <img
              src="https://modern.b-cdn.net/wp-content/uploads/2020/06/exterior-00-818x417.jpg"
              alt="About Us"
              className="w-full h-auto mt-16"
            />
          </div>
        </div>
      </div>
    </div>
  );
}