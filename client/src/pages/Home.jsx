import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import ListingItem from '../components/ListingItem';

export default function Home() {
  const [offerListings, setOfferListings] = useState([]);
  const [saleListings, setSaleListings] = useState([]);
  const [rentListings, setRentListings] = useState([]);


  useEffect(() => {
    const fetchOfferListings = async () => {
      try {
        const res = await fetch('http://localhost:8000/api/listings/get?offer=true&limit=4');
        const data = await res.json();
        setOfferListings(data);
        fetchRentListings();
      } catch (error) {
        console.log(error);
      }
    };
    const fetchRentListings = async () => {
      try {
        const res = await fetch('http://localhost:8000/api/listings/get?type=rent&limit=4');
        const data = await res.json();
        setRentListings(data);
        fetchSaleListings();
      } catch (error) {
        console.log(error);
      }
    };

    const fetchSaleListings = async () => {
      try {
        const res = await fetch('http://localhost:8000/api/listings/get?type=sale&limit=4');
        const data = await res.json();
        setSaleListings(data);
      } catch (error) {
        console.log(error);
      }
    };
    fetchOfferListings();
  }, []);

  return (
    <div >
       {/* top */}

       <div className='w-full h-[90vh]'>   
         <img src="https://modern.b-cdn.net/wp-content/uploads/2020/06/condos-00-1240x720.jpg"
         alt=""
         className='w-full h-full '/>
      </div>
       <div className='max-w-[1140px] m-auto'>
          <div className='absolute top-[40%] w-full md:-[50%] max-w-[600px] h-full flex flex-col p-4'> 
             <h2 className='font-bold text-4xl  text-slate-700'>Online Delala is the best place to find your dream propertiy</h2>
          </div>
          </div>
          <div className='max-w-[1140px] m-auto w-full md:flex mt-[-75px]'>
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

      {/* listing results for offer, sale and rent */}

      <div className='max-w-6xl mx-auto p-3 flex flex-col gap-8 my-10'>
        {offerListings && offerListings.length > 0 && (
          <div>
            <div className='my-3'>
              <h2 className='text-5xl font-bold text-slate-600 text-center'>Recent offers</h2><br/>
              <h2 className='text-gray-400 text-xs sm:text-sm text-center'>Online Delala is the best place to find your next perfect place to live</h2>
              <h2 className='text-gray-400 text-center'>check out some of latest our property</h2>
          <div className='text-center'>
            <Link className='text-sm text-blue-800 hover:underline ' to={'/search?offer=true'}>Show more offers</Link>
            </div>
            </div><br/><br/>
            <div className='flex flex-wrap gap-4'>
              {offerListings.map((listing) => (
                <ListingItem listing={listing} key={listing.id} />
              ))}
            </div>
          </div>
        )}
        {rentListings && rentListings.length > 0 && (
          <div>
            <div className='my-3'>
              <h2 className='text-5xl font-semibold text-slate-600 text-center'>Recent places for rent</h2><br/>
              <h2 className='text-gray-400 text-xs sm:text-sm text-center'>Online Delala is the best place to find your next perfect place to live </h2>
              <h2 className='text-gray-400 text-center'>check out some of latest our property</h2>
          <div className='text-center'>
            <Link className='text-sm text-blue-800 hover:underline' to={'/search?type=rent'}>Show more places for rent</Link>
          </div>
          </div><br/><br/>
            <div className='flex flex-wrap gap-4'>
              {rentListings.map((listing) => (
                <ListingItem listing={listing} key={listing.id} />
              ))}
            </div>
          </div>
        )}
        {saleListings && saleListings.length > 0 && (
          <div className=''>
            <div className='my-3'>
              <h2 className='text-5xl font-semibold text-slate-600 text-center'>Recent places for sale</h2><br/>
              <h2 className='text-gray-400 text-xs sm:text-sm text-center'>Online Delala is the best place to find your next perfect place to live</h2>
              <h2 className='text-gray-400 text-center'>check out some of latest our property</h2>
          <div className='text-center'>
            <Link className='text-sm  text-blue-800 hover:underline' to={'/search?type=sale'} >Show more places for sale</Link>
            </div>
            </div><br/>
            <div className='flex flex-wrap gap-4'>
              {saleListings.map((listing) => (
                <ListingItem listing={listing} key={listing.id} />
              ))}
            </div>
          </div>
        )}
      </div>
    </div>
  );
}