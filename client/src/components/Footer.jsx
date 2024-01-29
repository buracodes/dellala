import { FaFacebook, FaTwitter, FaInstagram, FaLinkedin, FaPhone } from 'react-icons/fa';

export default function Footer() {
  return (
    <footer className="bg-gray-800 text-white mt-auto">
       <div className="container mx-auto py-5 px-7">
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
                          <li className="mb-2"><a href="/Service">Service</a></li>
                          <li className="mb-2"><a href="/About">About</a></li>
                          <li className="mb-2"><a href="/Search">Search</a></li>
                       </ul>
                   </div>
                     <div className="w-full md:w-1/4">
                        <h4 className="text-xl font-bold ">Stay Connected</h4>
                           <div className="flex items-center mt-4">
                              <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" className="mr-4">
                                 <FaFacebook className="text-2xl" />
                              </a>
                              <a href="https://www.twitter.com" target="_blank" rel="noopener noreferrer" className="mr-4">
                                 <FaTwitter className="text-2xl" />
                              </a>
                              <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer" className="mr-4">
                                 <FaInstagram className="text-2xl" />
                              </a>
                              <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer">
                                 <FaLinkedin className="text-2xl" />
                              </a>
                            </div>
                            <div className="mt-4">
                               <h4 className='font-semibold text-xl'>Contact Me</h4>
                               <div className='mt-4 flex items-center'>
                                  <FaPhone className='text-xl' />
                                  <h4 className='font-semibold text-xl ml-2'>+25 19 11 35 62 86</h4>
                               </div>
                            </div>
                       </div>
         </div>
            <div className="text-center mt-4">
               <h1 className="text-sm">&copy; Company. All Rights Reserved</h1>
            </div>
      </div>
    </footer>
  );
}