/**
 * Class that handles the tracks.
 */
export class Track {
    async init() {
        this.pathSegments = window.location.pathname.split('/').filter(segment => segment !== '');
        this.slug = this.pathSegments[this.pathSegments.length - 1];

        await this.populateTracks();
    }

    static async create() {
        const instance = new Track();
        await instance.init();
        return instance;
    }

    /**
     * Populates the artist tracks section with Spotify embedded players based on the artist slug.
     */
    async populateTracks() {
        const artistTracks = document.getElementById('artistTracks');

        const tracks = {
            'hardwell': ['6L5xbckRDXIf5K1pwTaGkD', '49ZuJYjop8st6JwHWquK0u', '0GOXlShsWOp7BQ7nt9uwUL', '3EQ70Nq9D03VLRblD2JlJZ'],
            'armin-van-buuren': ['5GjnIpUlLGEIYk052ISOw9', '1moFkZDqcjQNeXtyoanLHv', '6wLqNGHQIja6xqT0cfrzBB', '2Fv1x10CiHukDdu96CYeHc'],
            'martin-garrix': ['23L5CiUhw2jV1OIMwthR3S', '3ebXMykcMXOcLeJ9xZ17XH', '52dEZA0A4siRTuA4e8w3ll', '7KPcippmg9MvPzb3dzNpQW'],
            'tiesto': ['09CnYHiZ5jGT1wr1TXJ9Zt', '36gcliMRX1vCpgnrZE3dFZ', '3IhM5Mber8KA0NaRNpK2px', '3j11iDncb7ZeDMw7lFucqM'],
            'nicky-romero': ['1sh6lL6cmlcwhqZKGiKBua', '4utBk1Fp8UwMbc1YBcoA4D', '1eL80CN0UF5aBsncWBPfFQ', '2bsyecmZCgdlsCZ3sWVZ99'],
            'afrojack': ['4QNpBfC0zvjKqPJcyqBy9W', '5Ok52kEHxudhX1n2RvqyIe', '5VtRjcZYvXj1VdT3FWG3ZD', '5DdDbJvoaT8fqQMJkiGg4T']
        }

        if (tracks[this.slug]) {
            for (const trackId of tracks[this.slug]) {
                const track = this.createTrack(trackId);
                artistTracks.appendChild(track);
            }
        }
    }

    /**
     * Creates and returns a Spotify embed iframe for a given track ID.
     *
     * @param {string} trackId - The Spotify track ID.
     * @returns {HTMLIFrameElement} The iframe element to be appended to the DOM.
     */
    createTrack(trackId) {
        const iframe = document.createElement('iframe');
        iframe.src = `https://open.spotify.com/embed/track/${trackId}`;
        iframe.width = '300';
        iframe.height = '80';
        iframe.allowFullScreen=""
        iframe.allow = 'encrypted-media';
        iframe.loading="lazy";

        return iframe;
    }
}