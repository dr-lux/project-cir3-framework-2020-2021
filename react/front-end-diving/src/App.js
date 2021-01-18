import './App.css';

// Thirds services
import {
  Link,
  Route,
  BrowserRouter as Router,
  Switch
} from "react-router-dom";

import React, { useState } from 'react';
import SimulateDiving from './Components/SimulateDiving';
import IconMenu from './Components/IconMenu';
// Icons imports
import homeIcon from './Icons/home-icon.webp';
import calculatorIcon from "./Icons/calculator-icon.png";
import Tables from './Components/Tables';

export default function App() 
{
  const [headerState, setHeaderState] = useState(true);

  const onLinkClick = e => 
  {
    setHeaderState(!headerState);
  };

  const onHomeClick = e => 
  {
    setHeaderState(true);
  };

  return (
    <Router>
      <div className="App">
        <header className={headerState ? "App-header" : "App-header-hidden"}>
          <div className="Container">
            <nav>
              <ul>
                <li>
                  <Link to="/" onClick={onHomeClick}>
                    <IconMenu iconPath={homeIcon} altName="Home" headerState={headerState}/>
                  </Link>
                </li>
                <li>
                  <Link to="/dive-simulator" onClick={onLinkClick}>
                    <IconMenu iconPath={calculatorIcon} altName="Simulate diving" headerState={headerState}/>
                  </Link>
                </li>
                <li>
                  <Link to="/dive-tables" onClick={onLinkClick}>
                    Tables de plongées
                  </Link>
                </li>
              </ul>
            </nav>
          </div>
        </header>
        <Switch>
          <Route path="/dive-simulator">
            <SimulateDiving />
          </Route>
          <Route path="/dive-tables">
            <Tables/>
          </Route>
        </Switch>
      </div>
    </Router>
  );
}