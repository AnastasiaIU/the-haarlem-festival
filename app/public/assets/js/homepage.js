import {CMS} from "./classes/CMS.js";
import {fetchFromApi} from "./main.js";

document.addEventListener("DOMContentLoaded", async function () {
    if(window.location.pathname === "/"){

    
    const scheduleContainer = document.querySelector(".schedule");

    // Function to fetch the homepage banner
    async function fetchHomepageBannerData() {
        try {
            const response = await fetch('/api/getHomepage');  
            const data = await response.json();

            
            document.getElementById("homepageBanner").src = `/assets/images/${data.image}`;  
            document.querySelector(".oval-text-overlay h1").textContent = data.hero_title;
            document.querySelector(".oval-text-overlay p").textContent = data.hero_description;
        } catch (error) {
            console.error("Error fetching homepage banner:", error);
        }
    }

    async function fetchEventsData(){
        try {
            const response = await fetch('/api/getEvents');
            const data = await response.json();
    
            data.forEach(event => {
                switch (event.slug) {
                    case 'yummy':
                    if (event.home_page_title) document.querySelector('.yummy-section .text-overlay h2').textContent = event.home_page_title;
                    if (event.home_page_description) document.querySelector('.yummy-section .text-overlay p').innerHTML = event.home_page_description;
                    if (event.image) document.querySelector('.yummy-banner img').src = `/assets/images/${event.image}`;
                    break;

                    case 'strolls':
                        if (event.home_page_title) document.querySelector('.strolls-section .text-overlay h2').textContent = event.home_page_title;
                        if (event.home_page_description) document.querySelector('.strolls-section .text-overlay p').innerHTML = event.home_page_description;
                        if (event.image) document.querySelector('.strolls-banner img').src = `/assets/images/${event.image}`;
                        break;

                    case 'dance':
                        if (event.home_page_title) document.querySelector('.dance-section .text-overlay h2').textContent = event.home_page_title;
                        if (event.home_page_description) document.querySelector('.dance-section .text-overlay p').innerHTML = event.home_page_description;
                        if (event.image) document.querySelector('.dance-banner img').src = `/assets/images/${event.image}`;
                        break;

                    case 'teylers':
                        if (event.home_page_title) document.querySelector('.museum-section .text-overlay h2').textContent = event.home_page_title;
                        if (event.home_page_description) document.querySelector('.museum-section .text-overlay p').innerHTML = event.home_page_description;
                        if (event.image) document.querySelector('.museum-banner img').src = `/assets/images/${event.image}`;
                        break;
                }
            });
    
        } catch (error) {
            console.error("Error fetching events data:", error);
        }
    }

    async function setTeylersContent() {
            const appPromotionTitle = await fetchFromApi('/api/getCustomByIdentifier/app_promotion_title');
            const appPromotionSubtitle = await fetchFromApi('/api/getCustomByIdentifier/app_promotion_subtitle');

            const promotionTitle = document.getElementById("appPromotionTitle");
            const promotionSubtitle = document.getElementById("appPromotionSubtitle");
    
            promotionTitle.innerHTML = appPromotionTitle.content;
            promotionSubtitle.innerHTML = appPromotionSubtitle.content;
    
            const appPromotionHero = document.getElementById("appPromotionHero");
            appPromotionHero.style.display = "block";

            const cms = await CMS.create();
            cms.setContentInputDataset(promotionTitle.id, 'custom', appPromotionTitle.id, 'content');
            cms.setContentInputDataset(promotionSubtitle.id, 'custom', appPromotionSubtitle.id, 'content');
        }

    async function fetchCustomData() {
        try {
            let response = await fetch('/api/getCustomByIdentifier/schedule_title');
            let data = await response.json();
            document.querySelector(".custom_schedule_title").textContent = data.content;

            response = await fetch('/api/getCustomByIdentifier/schedule_subtitle');
            data = await response.json();
            document.querySelector(".custom_schedule_subtitle").textContent = data.content;
        } catch (error) {
            console.error("Error fetching custom data:", error);
        }
    }

    async function fetchButtonById(buttonId, selector) {
        try {
            const response = await fetch(`/api/getButtonById/${buttonId}`);
    
            const button = await response.json();

            if (button && button.text && button.link) {
                document.querySelectorAll(`a[data-button-id="${buttonId}"]`).forEach(a => {
                    a.textContent = button.text;  
                    a.href = button.link;         
                });
            } else {
                console.log('Button does not contain text or link:', button);
            }
        } catch (error) {
            console.error(`Error fetching button with ID ${buttonId}:`, error);
        }
    }
    
    fetchButtonById(1);  
    fetchButtonById(2);  
    fetchButtonById(3); 
    fetchButtonById(4); 

    async function fetchTextByType(type, selector) {
        try {
            const response = await fetch(`/api/getTextByType/${type}`);
            const data = await response.json();
    
            if (data && data.text) {
                document.querySelectorAll(selector).forEach(a => {
                    a.textContent = data.text;
                });
            }
        } catch (error) {
            console.error(`Error fetching text for type "${type}":`, error);
        }
    }
    fetchTextByType('location', 'a[href="#map-section"]');

    await fetchHomepageBannerData();
    await fetchEventsData();
    await fetchCustomData();
    await setTeylersContent();


    function renderSchedule(schedule) {
        scheduleContainer.innerHTML = ""; // Clear previous content

        schedule.forEach(day => {
            const scheduleRow = document.createElement("div");
            scheduleRow.classList.add("schedule-row");

            const dateDiv = document.createElement("div");
            dateDiv.classList.add("date");
            dateDiv.innerHTML = `<span class="day h3 fw-bold">${day.day}</span>
                                 <span class="weekday">${day.weekday}</span>`;
            scheduleRow.appendChild(dateDiv);

            day.events.forEach(event => {
                const eventDiv = document.createElement("div");
                eventDiv.classList.add("event");
                eventDiv.innerHTML = `
                    <span class="event-title h3" style="color:#${event.title_color}">${event.title}</span>
                    <span class="event-time">${formatTime(event.start_time)} - ${formatTime(event.end_time)}</span>
                `;
                scheduleRow.appendChild(eventDiv);
            });

            scheduleContainer.appendChild(scheduleRow);
        });
    }

    function getDayAndWeekday(dateString) {
        const date = new Date(dateString);
        const options = { weekday: 'long', day: 'numeric' };
        return {
            day: date.getDate(),
            weekday: date.toLocaleDateString('en-US', options)
        };
    }

    function groupEventsByDate(events) {
        const groupedSchedule = [];

        events.forEach(event => {
            let dayGroup = groupedSchedule.find(group => group.date === event.date);

            if (!dayGroup) {
                dayGroup = {
                    date: event.date,
                    day: new Date(event.date).getDate(), 
                    weekday: new Date(event.date).toLocaleDateString('en-US', { weekday: 'long' }), 
                    events: []
                };
                groupedSchedule.push(dayGroup);
            }

            dayGroup.events.push({
                title: event.title,
                start_time: event.start_time,
                end_time: event.end_time,
                title_color: event.title_color
            });
        });

        return groupedSchedule;
    }

    
    function fetchSchedule() {
        fetch("/api/getSchedules")
            .then(response => response.json())
            .then(data => {
                const groupedData = groupEventsByDate(data);  
                renderSchedule(groupedData);  
            })
            .catch(error => console.error("Error fetching schedule:", error));
    }


    fetchSchedule();}
});

function formatTime(timeString) {
    const date = new Date(`1970-01-01T${timeString}Z`); 
    const hours = date.getHours().toString().padStart(2, '0');
    const minutes = date.getMinutes().toString().padStart(2, '0');
    return `${hours}:${minutes}`; 
}