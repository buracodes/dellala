import {BrowserRouter,Routes,Route} from 'react-router-dom';
import Home from "./pages/Home";
import Signin from './pages/Signin';
import Signup from './pages/Signup';
import Profile from './pages/Profile';
import About from './pages/About';
import Header from './components/Header';
import Service from './pages/Service';
import PrivateRoute from './components/PrivateRoute';
import CreateListing from './pages/CreateListing';
import UpdateListing from './pages/UpdateListing';

export default function App() {
  return (
   <BrowserRouter>
   <Header/>
   <Routes>
    <Route path ="/" element={<Home/>} />
    <Route path ="/Signin" element={<Signin/>} />
    <Route path ="/Signup" element={<Signup/>} />
    <Route element={<PrivateRoute />}>
          <Route path='/profile' element={<Profile />} />
          <Route path='/createlisting' element={<CreateListing />} />
          <Route path='/updatelisting/:listingId' element={<UpdateListing/>} />
        </Route>
    <Route path ="/About" element={<About/>} />
    <Route path ="/Service" element={<Service/>} />
   </Routes>
   </BrowserRouter>
  )
}
