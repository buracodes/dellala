

export default function Service() {
  return (
    <div className="overflow-x-hidden">
      <div className="w-full h-72 relative">
        <img
          src="https://modern.b-cdn.net/wp-content/uploads/2017/06/dining-00-1240x720.jpg"
          alt="image"
          className="w-full h-full object-cover brightness-50"
        />
        <div className="absolute top-0 left-0 w-full h-full flex flex-col ml-32 justify-center text-white">
           <h2 className="text-4xl font-bold">Service</h2>
           <h2 className="text-xl font-bold mt-5">Online Delala {">"} Service</h2>
         </div>
      </div>

      <div className="mb-20">
      <h5 className="text-2xl font-semibold text-slate-700 text-center mt-10">Our service</h5>
      <div className='max-w-[1140px] m-auto w-full md:flex  mt-10'>
             <div className='relative p-4'>
                <h3 className='absolute z-10 top-[50%] left-[50%] translate-y-[-50%] text-white text-3xl font-bold'>Buy</h3>
                <img src="https://modern.b-cdn.net/wp-content/uploads/2017/06/exterior-04-1240x720.jpg"
                className='w-full h-full object-cover relative border-4 border-white shodow-lg duration-300 ease-in-out hover:scale-110'/>
              </div>
              <div className='relative p-4'>
                <h3 className='absolute z-10 top-[50%] left-[50%] translate-y-[-50%] text-white text-2xl font-bold'>Sell</h3>
                 <img src="https://modern.b-cdn.net/wp-content/uploads/2017/06/exterior-05.jpg"
                 className='w-full h-full object-cover relative border-4 border-white shodow-lg duration-300 ease-in-out hover:scale-110'/>
              </div>
              <div className='relative p-4'>
                <h3 className='absolute z-10 top-[50%] left-[50%] translate-y-[-50%] text-white text-2xl font-bold'>Rent</h3>
              <img src="https://modern.b-cdn.net/wp-content/uploads/2017/06/living-01.jpg"
              className='w-full h-full object-cover relative border-4 border-white shodow-lg duration-300 ease-in-out hover:scale-110'/>
              </div>
          </div>
          </div>

    </div>
    
  );
}
