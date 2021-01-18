import React from 'react';

export default function IconMenu({iconPath, altName, headerState}) 
{
    return (
        <img 
            src={iconPath} 
            className={headerState ? "Icon-menu" : "Icon-menu-hidden"} 
            alt={altName} title={altName}/>
    )
}