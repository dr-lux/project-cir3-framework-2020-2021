import Config from './Config';

/**
 * Tooling class for app.
 */
export default class Tool
{
    /**
     * Fill an symfony-like url with the values in params
     * @param {object} params Parameters to set in the url
     * @param {string} url Url to transform
     * @returns {string} The built api url
     */
    static buildApiUrl(params, url)
    {
        let api = url.substr(Config.getUrl("staticUrl").length, url.length - 1);
        let fields = api.split("/");
        let builtUrl = [];
        for (var field of fields)
        {
            if (field.startsWith("{"))
            {
                let name = field.substr(1, field.length - 2);
                if (name in params)
                {
                    builtUrl.push(params[name]);
                }
            }
            else 
            {
                builtUrl.push(field);
            }
        }
        return Config.getUrl("staticUrl") + builtUrl.reduce((previousValue, currentValue) => previousValue += "/" + currentValue);
    }

    /**
     * Fetch request options to call API
     * @returns {object} RequestOptions
     */
    static getRequestOptions()
    {
        return {
            method: 'GET'
        };
    }

    static async fetchAndJson(url, unique = false,requestOptions = undefined)
    {
        requestOptions = requestOptions ?? this.getRequestOptions();

        let res = await fetch(url, requestOptions);
        let o = await res.json();
        if (unique)
        {
            if (o instanceof Array)
            {
                if (o.length === 1) return o[0];
            }
        }
        return o;
    }
}