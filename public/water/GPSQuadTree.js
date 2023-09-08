const GPSQT = {

    mkTree: function(unsorted, xmin=-180, xmax=180, ymin=-90, ymax=90) {
        var workingArr = [[], [], [], []];

        if(unsorted.length < 100) return unsorted;

        for(var i=0; i<unsorted.length; i++) {
            var xref = Math.round( (unsorted[i].coords[1] - xmin) / (xmax-xmin) );
            var yref = Math.round( (unsorted[i].coords[0] - ymin) / (ymax-ymin) );
            var arrRef = yref*2 + xref;
            workingArr[arrRef].push(unsorted[i]);
        }

        for(var j=0; j<4; j++) {
            const newymin = ymin + Math.floor(j/2) * (ymax-ymin)/2;
            const newxmin = xmin + j % 2 * (xmax-xmin)/2;
            const newymax = newymin + (ymax-ymin)/2;
            const newxmax = newxmin + (xmax-xmin)/2;
            workingArr[j] = this.mkTree(workingArr[j], newxmin, newxmax, newymin, newymax);
        }

        return workingArr;
        
    },


    findInTree: function( checkTree, lat, lng, xmin=-180, xmax=180, ymin=-90, ymax=90 ) {

        var xref = Math.round( (lng-xmin) / (xmax-xmin) );
        var yref = Math.round( (lat-ymin) / (ymax-ymin) );
        var arrRef = yref*2 + xref;

        const newymin = ymin + Math.floor(arrRef/2) * (ymax-ymin)/2;
        const newxmin = xmin + arrRef % 2 * (xmax-xmin)/2;
        const newymax = newymin + (ymax-ymin)/2;
        const newxmax = newxmin + (xmax-xmin)/2;
        
        if(checkTree[arrRef].length == 0) {
            return checkTree;
        }
        
        if(checkTree[arrRef][0].ID) {
            return checkTree;
        }

        return this.findInTree(checkTree[arrRef], lat, lng, newxmin, newxmax, newymin, newymax);

    },


    findRefChain: function( checkTree, lat, lng, xmin=-180, xmax=180, ymin=-90, ymax=90, refChain=[] ) {

        var xref = Math.round( (lng-xmin) / (xmax-xmin) );
        var yref = Math.round( (lat-ymin) / (ymax-ymin) );
        var arrRef = yref*2 + xref;
        refChain.push(arrRef);

        const newymin = ymin + Math.floor(arrRef/2) * (ymax-ymin)/2;
        const newxmin = xmin + arrRef % 2 * (xmax-xmin)/2;
        const newymax = newymin + (ymax-ymin)/2;
        const newxmax = newxmin + (xmax-xmin)/2;
        
        if(checkTree[arrRef].length == 0) {
            return refChain;
        }
        
        if(checkTree[arrRef][0].ID) {
            return refChain;
        }

        return this.findRefChain(checkTree[arrRef], lat, lng, newxmin, newxmax, newymin, newymax, refChain);

    },


    concatTree: function(GPSQuadTree) {

        var workingArr=[];
        
        for(var i=0; i < GPSQuadTree.length; i++) {
            if(typeof GPSQuadTree[i] == "object") {

                if(GPSQuadTree[i].ID) return GPSQuadTree;
                
                else {
                    workingArr = workingArr.concat(
                        this.concatTree( GPSQuadTree[i] )
                    );
                }
            }
        }

        return workingArr;

    }

}