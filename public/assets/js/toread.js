function ToReadViewModel() {
    var self = this;

    self.newToRead = ko.observable("");
    self.toReadList = ko.observableArray([]);

    const STORAGE_KEY = "toReadList";

    self.addToRead = function() {
        if (self.newToRead()) {
            self.toReadList.push(self.newToRead());
            self.newToRead("");
            save();
        }
    };

    self.removeToRead = function(item) {
        self.toReadList.remove(item);
        save();
    };

    function save() {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(self.toReadList()));
    }

    function load() {
        const saved = localStorage.getItem(STORAGE_KEY);
        if (saved) {
            self.toReadList(JSON.parse(saved));
        }
    }

    load();
}

ko.applyBindings(new ToReadViewModel());


