/**
 * @jest-environment jsdom
 */

 import axios from 'axios';
 import { jest, describe, expect, it } from '@jest/globals'
 import { mount } from '@vue/test-utils'
 import FileImporter from './FileImporter'
 
 describe('FileImporter.vue', () => {
 
   it('Renders', () => {
 
     const wrapper = mount(FileImporter, {        
        propsData: {
            postUrl: '/api/test',
        },
     });
     //Has Import File
     expect(wrapper.get('[data-test="file"]').exists()).toBe(true);
     //Has Upload Button 
     expect(wrapper.get('[data-test="upload"]').exists()).toBe(true);
 
   });
 
  it('Triggers a request to the api', async () => {
 
    jest.spyOn(axios, 'post').mockResolvedValue(
      {
        response: {
          status: 202,
        }
      }
    );

    const wrapper = mount(FileImporter, {        
      propsData: {
          postUrl: '/api/test',
      },
    });

    await wrapper.get('[data-test="upload"]').trigger('click');

    expect(axios.post).toHaveBeenCalledTimes(1)
    expect(axios.post).toHaveBeenCalledWith("/api/test", expect.anything(), {"headers": {"Content-Type": "multipart/form-data"}});

  });

 });