import './App.css'
import {Routes,Route} from 'react-router-dom';
import Home from './component/Home';
import About from './component/About';
import Contact from './component/Contact';
function App() {

  return (
    <>
     <Routes>
      <Route path='/' element={<Home/>}/>
      <Route path='/about' element={<About/>}/>
      <Route path='/contact' element={<Contact/>}/>
     </Routes>
    </>
  )
}

export default App
