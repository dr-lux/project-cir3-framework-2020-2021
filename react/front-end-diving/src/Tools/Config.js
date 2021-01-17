import config from '../paths.json';

export default class Config
{
    /**
     * urls: staticUrl | profondeur | temps | defaultParam | depth | search
     * @param {string} url name of the stored api url.
     */
    static getUrl(url)
    {
        return config[url];
    }
}