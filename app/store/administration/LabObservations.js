/**
 * Created by JetBrains PhpStorm.
 * User: Ernesto J. Rodriguez (Certun)
 * File:
 * Date: 2/18/12
 * Time: 11:09 PM
 */


Ext.define('App.store.administration.LabObservations', {
	model: 'App.model.administration.LabObservations',
	extend: 'Ext.data.Store',
	proxy: {
		type       : 'direct',
		api        : {
			read  : Services.getLabObservations,
			create: Services.addLabObservations,
			update: Services.updateLabObservations,
			destroy: Services.removeLabObservations
		}
	},
    autoSync: true,
	autoLoad  : false
});