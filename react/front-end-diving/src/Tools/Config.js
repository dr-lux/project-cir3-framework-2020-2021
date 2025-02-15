import config from '../paths.json';

/**
 * DAL interfacing class.
 */
export default class Config
{
    /**
     * urls: staticUrl | profondeur | temps | defaultParam | depth | search
     * @param {string} url name of the stored api url.
     */
    static getUrl(url)
    {
        return config[url] ?? "";
    }

    /**
     * urls: profondeur | temps | defaultParam | depth | search
     * @param {string} url name of the stored api url.
     */
    static getApiUrl(url)
    {
        return this.getUrl("staticUrl") + this.getUrl(url);
    }
}