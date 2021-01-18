"use-strict";

/**
 * DTO
 */
export default class Temps 
{
    id;
    time;
    depth;
    palier15;
    palier12;
    palier9;
    palier6;
    palier3;

    /**
     * Constructor for the DTO.
     * @param {object} data REST data from the API ({id, temps, depth, palier...})
     */
    constructor(data)
    {
        this.id = data?.id;
        this.time = data?.temps;
        this.depth = data?.depth;
        this.palier15 = data?.palier15;
        this.palier12 = data?.palier12;
        this.palier9 = data?.palier9;
        this.palier6 = data?.palier6;
        this.palier3 = data?.palier3;

        if (!this.id && !this.time && !this.depth && !this.palier15 && !this.palier12 && !this.palier9 &&
            !this.palier6 && !this.palier3)
        {
            throw new Error("All fields are null, check object type or if data is null");
        }
    }

    /**
     * Constructs an array of Temps from an array of REST data.
     * @param {object[]} array Array of API REST data
     * @returns {Array<Temps>} The constructed instances of Temps from array
     */
    static buildAllFromArray(array)
    {
        let tempsArray = [];
        array.forEach(temps => {
            tempsArray.push(new Temps(temps));
        });
        return tempsArray;
    }

    /**
     * @returns {string}
     */
    toString() 
    {
        let paliers = "\n";
        paliers += "\tpalier 3: " + this.palier3;
        paliers += "\n\tpalier 6: " + this.palier6;
        paliers += "\n\tpalier 9: " + this.palier9;
        paliers += "\n\tpalier 12: " + this.palier12;
        paliers += "\n\tpalier 15: " + this.palier15;

        return "id: " + this.id + ",\ntemps: " + this.time + "\npaliers: " + paliers;
    }

    /**
     * Calculates the total time spent going up after diving (DTR).
     * @returns {number}
     */
    getDTR()
    {
        let paliers = [this.palier15, this.palier12, this.palier9, this.palier6, this.palier3];
        let numPalier = [];

        for (var i = 0; i < paliers.length; i++)
        {
            if (!Number.isNaN(Number.parseInt(paliers[i])))
            {
                numPalier.push(Number.parseInt(paliers[i]));
            }
        }

        return numPalier.reduce((previousValue, currentValue) => previousValue + currentValue, 0);
    }

    /**
     * Calculates the total time spent diving (DTP).
     * @param {number} divingDownSpeed Speed of dive (when going down)
     * @returns {number} Total time spent
     */
    getDTP(divingDownSpeed)
    {
        if (!divingDownSpeed) return 0;
        else if (divingDownSpeed && typeof divingDownSpeed != "number") throw new Error("Provided diving speed is not a number");
        
        return (this.depth / divingDownSpeed) + this.time + this.getDTR();
    }

    /**
     * Calculates to total air consumed.
     * @param {number} airConsuption Average air consumption
     * @param {number} airVolume Amount of air available
     * @param {number} divingDownSpeed Speed going down
     * @param {number} divingUpSpeed Speed going up (before any bearing)
     * @param {number} divingUpAfterSpeed Speed going up (after a bearing)
     * @returns {number}
     */
    getAirConsumedVolume(airConsuption, airVolume, divingDownSpeed = 20, divingUpSpeed = 10, divingUpAfterSpeed = 6)
    {
        let avgDownPressure = this.getAvgPressure(Math.ceil(this.depth / 10));
        let diveDownAirConsumed = airConsuption * avgDownPressure;

        let diveAirConsumed = airConsuption * (this.depth / 10);

        let diveUpAirConsumed = 0;

        let currentDepth = this.depth;
        let currentUpSpeed = divingUpSpeed;
        let paliers = [
            {
                "depth": 15,
                "time": this.palier15
            }, 
            {
                "depth": 12,
                "time": this.palier12
            },
            {
                "depth": 9,
                "time": this.palier9
            },
            {
                "depth": 6,
                "time": this.palier6
            },
            {
                "depth": 3,
                "time": this.palier3
            }
        ];

        paliers.forEach(value => 
        {
            diveUpAirConsumed += this.getBearingAirConsumed(airConsuption, value.depth, currentDepth, currentUpSpeed, value.time);
            currentDepth = value.depth;

            if (currentUpSpeed !== divingUpAfterSpeed)
            {
                currentUpSpeed = divingUpAfterSpeed;
            }
        });

        return diveDownAirConsumed + diveAirConsumed + diveUpAirConsumed;
    }

    /**
     * Calculate the average pressure the diver goes under when diving down.
     * @param {number} depth Maximum depth (minimum assumed to be 0)
     */
    getAvgPressure(depth)
    {
        let avg = 0;
        for (var i = 1; i <= depth; i++)
        {
            avg += i;
        }
        return avg / depth;
    }

    /**
     * Calculates the average pressure between 2 points under water.
     * @param {number} depth1 First point
     * @param {number} depth2 Second point
     */
    getAvgPressureBetween(depth1, depth2)
    {
        return (this.getDepthPressure(depth1) + this.getDepthPressure(depth2)) / 2;
    }

    /**
     * Calculates the pressure of a point underwater.
     * @param {number} depth Depth in meters
     */
    getDepthPressure(depth)
    {
        return (depth / 10) + 1;
    }

    /**
     * Calculates the total air consumption of the diver going to a bearing and staying at the bearing.
     * @param {number} airConsuption Air consumption of the diver
     * @param {number} bearingDepth Depth of the bearing to go to from @param currentDepth
     * @param {number} currentDepth Current depth of the diver
     * @param {number} currentUpSpeed Diver's speed when going up
     * @param {number} bearingStayTime Stay duration at the bearing
     */
    getBearingAirConsumed(airConsuption, bearingDepth, currentDepth, currentUpSpeed, bearingStayTime)
    {
        let toBearingAC = (airConsuption * this.getAvgPressureBetween(bearingDepth, currentDepth)) * currentUpSpeed;
        let atBearingAC = (airConsuption * this.getDepthPressure(9)) * bearingStayTime;

        return toBearingAC + atBearingAC;
    }
}