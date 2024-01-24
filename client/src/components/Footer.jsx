import { FaFacebook, FaTwitter, FaInstagram, FaLinkedin } from 'react-icons/fa';

export default function Footer() {
  return (
    <footer className="bg-gray-800 text-white">
      <div className="container mx-auto py-10 px-7">
        <div className="flex flex-wrap justify-between">
          <div className="w-full md:w-1/4">
            <div className="flex items-center mb-4">
              <span className="font-bold text-xl">Online Delala</span>
            </div>
            <p className="text-sm">We believe that buying or selling a property should be an exciting and rewarding experience, and we are dedicated to making that a reality for each and every one of our clients.</p>
          </div>
          <div className="w-full md:w-1/6">
            <h4 className="text-xl font-bold mb-4">Quick Links</h4>
            <ul>
              <li className="mb-2"><a href="/">Home</a></li>
              <li className="mb-2"><a href="/services">Services</a></li>
              <li className="mb-2"><a href="/About">About</a></li>
              <li className="mb-2"><a href="/Search">Search</a></li>
              
            </ul>
          </div>
          <div className="w-full md:w-1/4">
            <h4 className="text-xl font-bold mb-4">Stay Connected</h4>
            <div className="flex items-center">
              <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" className="mr-4">
                <FaFacebook className="text-white text-2xl" />
              </a>
              <a href="https://www.twitter.com" target="_blank" rel="noopener noreferrer" className="mr-4">
                <FaTwitter className="text-white text-2xl" />
              </a>
              <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer" className='mr-4'>
                <FaInstagram className="text-white text-2xl" />
              </a>
              <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer">
                <FaLinkedin className="text-white text-2xl" />
              </a>
            </div>
          </div>
        </div><br/><br/>
        <div className='text-center'>
             <h1>@Copyright Company. All Right Reserved</h1>
          </div>
      </div>
    </footer>
  );
}

